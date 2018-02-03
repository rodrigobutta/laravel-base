
var JSGantt; if (!JSGantt) JSGantt = {};

var vTimeout = 0;
var vBenchTime = new Date().getTime();

JSGantt.isIE = function () {

	if(typeof document.all != 'undefined')
		return true;
	else
		return false;
}



JSGantt.TaskItem = function(pID, pName, pStart, pEnd, pColor, pLink, pMile, pRes, pComp, pGroup, pParent, pOpen, pDepend, pCaption, pBarname)
{

      var vID    = pID;
      var vName  = pName;
      var vStart = new Date();
      var vEnd   = new Date();
      var vColor = pColor;
      var vLink  = pLink;
      var vMile  = pMile;
      var vRes   = pRes;
      var vComp  = pComp;
      var vGroup = pGroup;
      var vParent = pParent;
      var vOpen   = pOpen;
      var vDepend = pDepend;
      var vCaption = pCaption;
      var vBarname = pBarname;
      var vDuration = '';
      var vLevel = 0;
      var vNumKid = 0;
      var vVisible  = 1;
      var x1, y1, x2, y2;

      if (vGroup != 1)
      {
         vStart = JSGantt.parseDateStr(pStart,g.getDateInputFormat());
         vEnd   = JSGantt.parseDateStr(pEnd,g.getDateInputFormat());
      }

      this.getID       = function(){ return vID };
      this.getName     = function(){ return vName };
      this.getBarname     = function(){ if(vBarname) return vBarname; else return ''; };
      this.getStart    = function(){ return vStart};
      this.getEnd      = function(){ return vEnd  };
      this.getColor    = function(){ return vColor};
      this.getLink     = function(){ return vLink };
      this.getMile     = function(){ return vMile };
      this.getDepend   = function(){ if(vDepend) return vDepend; else return null };
      this.getCaption  = function(){ if(vCaption) return vCaption; else return ''; };
      this.getResource = function(){ if(vRes) return vRes; else return '&nbsp;';  };
      this.getCompVal  = function(){ if(vComp) return vComp; else return 0; };
      this.getCompStr  = function(){ if(vComp) return vComp+'%'; else return ''; };

      this.getDuration = function(){

        if (vMile){
            vDuration = '-';
        }
 		   else {
            tmpPer =  Math.ceil((this.getEnd() - this.getStart()) /  (24 * 60 * 60 * 1000) + 1);
            if(tmpPer == 1)  vDuration = '1 Día';
            else             vDuration = tmpPer + ' Días';
        }

         return( vDuration )
      };

      this.getParent   = function(){ return vParent };
      this.getGroup    = function(){ return vGroup };
      this.getOpen     = function(){ return vOpen };
      this.getLevel    = function(){ return vLevel };
      this.getNumKids  = function(){ return vNumKid };
      this.getStartX   = function(){ return x1 };
      this.getStartY   = function(){ return y1 };
      this.getEndX     = function(){ return x2 };
      this.getEndY     = function(){ return y2 };
      this.getVisible  = function(){ return vVisible };
	  this.setDepend   = function(pDepend){ vDepend = pDepend;};
      this.setStart    = function(pStart){ vStart = pStart;};
      this.setEnd      = function(pEnd)  { vEnd   = pEnd;  };
      // this.setLevel    = function(pLevel){ vLevel = pLevel;};
      this.setLevel    = function(pLevel){ vLevel = pLevel;};

      this.setNumKid   = function(pNumKid){ vNumKid = pNumKid;};
      this.setCompVal  = function(pCompVal){ vComp = pCompVal;};
      this.setStartX   = function(pX) {x1 = pX; };
      this.setStartY   = function(pY) {y1 = pY; };
      this.setEndX     = function(pX) {x2 = pX; };
      this.setEndY     = function(pY) {y2 = pY; };
      this.setOpen     = function(pOpen) {vOpen = pOpen; };
      this.setVisible  = function(pVisible) {vVisible = pVisible; };

  }


  // function that loads the main gantt chart properties and functions
  // pDiv: (required) this is a DIV object created in HTML
  // pStart: UNUSED - future use to force minimum chart date
  // pEnd: UNUSED - future use to force maximum chart date
  // pWidth: UNUSED - future use to force chart width and cause objects to scale to fit within that width
  // pShowRes: UNUSED - future use to turn on/off display of resource names
  // pShowDur: UNUSED - future use to turn on/off display of task durations
  // pCationType - what type of Caption to show:  Caption, Resource, Duration, Complete
JSGantt.GanttChart =  function(pGanttVar, pDiv)
{

      var vGanttVar = pGanttVar;
      var vDiv      = pDiv;
      var vShowRes  = 1;
      var vShowDur  = 1;
      var vShowComp = 1;
      var vShowStartDate = 1;
      var vShowEndDate = 1;
      var vDateInputFormat = "mm/dd/yyyy";
      var vDateDisplayFormat = "mm/dd/yyyy";
	  var vNumUnits  = 0;
      var vDepId = 1;
      var vTaskList     = new Array();


      this.setDateInputFormat = function(pShow) { vDateInputFormat = pShow; };
      this.setDateDisplayFormat = function(pShow) { vDateDisplayFormat = pShow; };

      this.getDateInputFormat = function() { return vDateInputFormat };
      this.getDateDisplayFormat = function() { return vDateDisplayFormat };
      this.CalcTaskXY = function ()
      {
         var vList = this.getList();
         var vTaskDiv;
         var vParDiv;
         var vLeft, vTop, vHeight, vWidth;

         for(i = 0; i < vList.length; i++)
         {
            vID = vList[i].getID();
            vTaskDiv = document.getElementById("taskbar_"+vID);
            vBarDiv  = document.getElementById("bardiv_"+vID);
            vParDiv  = document.getElementById("childgrid_"+vID);

            if(vBarDiv) {
               vList[i].setStartX( vBarDiv.offsetLeft );
               vList[i].setStartY( vParDiv.offsetTop+vBarDiv.offsetTop+6 );
               vList[i].setEndX( vBarDiv.offsetLeft + vBarDiv.offsetWidth );
               vList[i].setEndY( vParDiv.offsetTop+vBarDiv.offsetTop+6 );
            }
         }
      }

      this.AddTaskItem = function(value)
      {
         vTaskList.push(value);
      }

      this.getList   = function() { return vTaskList };

      this.clearDependencies = function()
      {
         var parent = document.getElementById('rightside');
         var depLine;
         var vMaxId = vDepId;
         for ( i=1; i<vMaxId; i++ ) {
            depLine = document.getElementById("line"+i);
            if (depLine) { parent.removeChild(depLine); }
         }
         vDepId = 1;
      }


      // sLine: Draw a straight line (colored one-pixel wide DIV), need to parameterize doc item
      this.sLine = function(x1,y1,x2,y2) {

         vLeft = Math.min(x1,x2);
         vTop  = Math.min(y1,y2);
         vWid  = Math.abs(x2-x1) + 1;
         vHgt  = Math.abs(y2-y1) + 1;

         vDoc = document.getElementById('rightside');

	 // retrieve DIV
	 var oDiv = document.createElement('div');

	 oDiv.id = "line"+vDepId++;
         oDiv.style.position = "absolute";
	 oDiv.style.margin = "0px";
	 oDiv.style.padding = "0px";
	 oDiv.style.overflow = "hidden";
	 oDiv.style.border = "0px";

	 // set attributes
	 oDiv.style.zIndex = 0;
	 oDiv.style.backgroundColor = "red";

	 oDiv.style.left = vLeft + "px";
	 oDiv.style.top = vTop + "px";
	 oDiv.style.width = vWid + "px";
	 oDiv.style.height = vHgt + "px";

	 oDiv.style.visibility = "visible";

	 vDoc.appendChild(oDiv);

      }


      // dLine: Draw a diaganol line (calc line x,y paisrs and draw multiple one-by-one sLines)
      this.dLine = function(x1,y1,x2,y2) {

         var dx = x2 - x1;
         var dy = y2 - y1;
         var x = x1;
         var y = y1;

         var n = Math.max(Math.abs(dx),Math.abs(dy));
         dx = dx / n;
         dy = dy / n;
         for ( i = 0; i <= n; i++ )
         {
            vx = Math.round(x);
            vy = Math.round(y);
            this.sLine(vx,vy,vx,vy);
            x += dx;
            y += dy;
         }

      }

      this.drawDependency =function(x1,y1,x2,y2)
      {
         if(x1 + 10 < x2)
         {
            this.sLine(x1,y1,x1+4,y1);
            this.sLine(x1+4,y1,x1+4,y2);
            this.sLine(x1+4,y2,x2,y2);
            this.dLine(x2,y2,x2-3,y2-3);
            this.dLine(x2,y2,x2-3,y2+3);
            this.dLine(x2-1,y2,x2-3,y2-2);
            this.dLine(x2-1,y2,x2-3,y2+2);
         }
         else
         {
            this.sLine(x1,y1,x1+4,y1);
            this.sLine(x1+4,y1,x1+4,y2-10);
            this.sLine(x1+4,y2-10,x2-8,y2-10);
            this.sLine(x2-8,y2-10,x2-8,y2);
            this.sLine(x2-8,y2,x2,y2);
            this.dLine(x2,y2,x2-3,y2-3);
            this.dLine(x2,y2,x2-3,y2+3);
            this.dLine(x2-1,y2,x2-3,y2-2);
            this.dLine(x2-1,y2,x2-3,y2+2);
         }
      }

      this.DrawDependencies = function () {

         //First recalculate the x,y
         this.CalcTaskXY();

         this.clearDependencies();

         var vList = this.getList();
         for(var i = 0; i < vList.length; i++)
         {

            vDepend = vList[i].getDepend();
            if(vDepend) {

               var vDependStr = vDepend + '';
               var vDepList = vDependStr.split(',');
               var n = vDepList.length;

               for(var k=0;k<n;k++) {
                  var vTask = this.getArrayLocationByID(vDepList[k]);

                  if(vList[vTask].getVisible()==1)
                     this.drawDependency(vList[vTask].getEndX(),vList[vTask].getEndY(),vList[i].getStartX()-1,vList[i].getStartY())
               }
  	    }
         }
      }


      this.getArrayLocationByID = function(pId)  {

         var vList = this.getList();
         for(var i = 0; i < vList.length; i++)
         {
            if(vList[i].getID()==pId)
               return i;
         }
      }


   this.Draw = function(taskName)
   {
      var vMaxDate = new Date();
      var vMinDate = new Date();
      var vTmpDate = new Date();
      var vNxtDate = new Date();
      var vCurrDate = new Date();
      var vTaskLeft = 0;
      var vTaskRight = 0;
      var vNumCols = 0;
      var vID = 0;
      var vMainTable = "";
      var vLeftTable = "";
      var vRightTable = "";
      var strTaskName = "";
      var vItemRowStr = "";
      var vColWidth = 0;
      var vColUnit = 0;
      var vChartWidth = 0;
      var vNumDays = 0;
      var vDayWidth = 0;
      var vStr = "";

      if(vTaskList.length > 0)
      {

		   // Process all tasks preset parent date and completion %
         JSGantt.processRows(vTaskList, 0, -1, 1, 1);

         // get overall min/max dates plus padding
         vMinDate = JSGantt.getMinDate(vTaskList);
         vMaxDate = JSGantt.getMaxDate(vTaskList);

        vColWidth = 18;
        vColUnit = 1;

         vNumDays = (Date.parse(vMaxDate) - Date.parse(vMinDate)) / ( 24 * 60 * 60 * 1000);
         vNumUnits = vNumDays / vColUnit;


         vChartWidth = vNumUnits * vColWidth + 1;
         // vDayWidth = (vColWidth / vColUnit) + (1/vColUnit);
         vDayWidth = 28.4;

         vMainTable =
            '<TABLE id="gantt_table"><TBODY><TR>' +
            '<TD vAlign=top bgColor=#ffffff>' +
            '<DIV class="scroll" id="leftside">' +
            '<TABLE>' +
            '<THEAD>' +
            '<tr>' +
            '  <th colspan=7 class="task-name">&nbsp;</th>' +
            '</tr>' +
            '<tr>' +
            '  <th></th>' +
            '  <th>Asignado</th>' +
            '  <th>Duración</th>' +
            '  <th>%</th>' +
            '  <th>Inicio</th>' +
            '  <th>Fin</th>' +
            '</tr>' +
            '</THEAD>' +
            '<TBODY>';

            for(i = 0; i < vTaskList.length; i++)
            {

                var modifiers = ''
               if( vTaskList[i].getGroup()) {
                  vRowType = "group";
                  modifiers += ' group';
               } else {
                  vRowType  = "row";
               }

               vID = vTaskList[i].getID();

  		        if(vTaskList[i].getVisible() == 0){
                    vLeftTable += '<TR class="' + modifiers + '" id=child_' + vID + ' style="display:none"  onMouseover=g.mouseOver(this,' + vID + ',"left","' + vRowType + '") onMouseout=g.mouseOut(this,' + vID + ',"left","' + vRowType + '")>' ;
                }
                else{
                    vLeftTable += '<TR class="' + modifiers + '" id=child_' + vID + ' onMouseover=g.mouseOver(this,' + vID + ',"left","' + vRowType + '") onMouseout=g.mouseOut(this,' + vID + ',"left","' + vRowType + '")>' ;
                }

                vLeftTable +=  '  <TD class="gname name" nowrap><NOBR><span>';

               for(j=1; j<vTaskList[i].getLevel(); j++) {
                  vLeftTable += '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
               }

               vLeftTable += '</span>';

               if( vTaskList[i].getGroup()) {
                  if( vTaskList[i].getOpen() == 1)
                     vLeftTable += '<SPAN id="group_' + vID + '" style="color:#000000; cursor:pointer; font-weight:bold; " onclick="JSGantt.folder(' + vID + ','+vGanttVar+');'+vGanttVar+'.DrawDependencies();"><i class="fa fa-folder-open"></i></span>' ;
                  else
                     vLeftTable += '<SPAN id="group_' + vID + '" style="color:#000000; cursor:pointer; font-weight:bold; " onclick="JSGantt.folder(' + vID + ','+vGanttVar+');'+vGanttVar+'.DrawDependencies();"><i class="fa fa-folder"></i></span>' ;

               } else {

                  vLeftTable += '<span><i class="fa fa-caret-right"></i></span>';
               }

               vLeftTable +=
                  '<span onclick=JSGantt.taskLink("' + vTaskList[i].getLink() + '",300,200); style="cursor:pointer"> ' + vTaskList[i].getName() + '</span></NOBR></TD>' ;

               if(vShowRes ==1) vLeftTable += '  <TD class="gname property"><NOBR>' + vTaskList[i].getResource() + '</NOBR></TD>' ;
               if(vShowDur ==1) vLeftTable += '  <TD class="gname property"><NOBR>' + vTaskList[i].getDuration() + '</NOBR></TD>' ;
               if(vShowComp==1) vLeftTable += '  <TD class="gname property"><NOBR>' + vTaskList[i].getCompStr()  + '</NOBR></TD>' ;
               if(vShowStartDate==1) vLeftTable += '  <TD class="gname property"><NOBR>' + JSGantt.formatDateStr( vTaskList[i].getStart(), vDateDisplayFormat) + '</NOBR></TD>' ;
               if(vShowEndDate==1) vLeftTable += '  <TD class="gname property"><NOBR>' + JSGantt.formatDateStr( vTaskList[i].getEnd(), vDateDisplayFormat) + '</NOBR></TD>' ;

               vLeftTable += '</TR>';

            }

            vLeftTable += '</TD></TR>';

            vLeftTable += '</TBODY></TABLE></TD>';

            vMainTable += vLeftTable;


            // Draw the Chart Rows
            vRightTable =
            '<TD id="gantt_td_left" vAlign=top bgColor=#ffffff>' +
            '<DIV class=scroll2 id=rightside>' +
            '<TABLE style="width: ' + vChartWidth + 'px;" cellSpacing=0 cellPadding=0 border=0>' +
            '<TBODY><TR style="HEIGHT: 18px">';

            vTmpDate.setFullYear(vMinDate.getFullYear(), vMinDate.getMonth(), vMinDate.getDate());
            vTmpDate.setHours(0);
            vTmpDate.setMinutes(0);

         // Major Date Header
         while(Date.parse(vTmpDate) <= Date.parse(vMaxDate))
         {
            vStr = vTmpDate.getFullYear() + '';
            vStr = vStr.substring(2,4);


            vRightTable += '<td class="gdatehead" colspan=7>';

            vRightTable += JSGantt.formatDateStr(vTmpDate,'dd/mm');

            vRightTable += ' al ';

            vTmpDate.setDate(vTmpDate.getDate()+6);

            vRightTable += JSGantt.formatDateStr(vTmpDate, 'dd/mm');

            vRightTable += '</td>';

            vTmpDate.setDate(vTmpDate.getDate()+1);


         }

         vRightTable += '</TR><TR>';

         // Minor Date header and Cell Rows
         vTmpDate.setFullYear(vMinDate.getFullYear(), vMinDate.getMonth(), vMinDate.getDate());
         vNxtDate.setFullYear(vMinDate.getFullYear(), vMinDate.getMonth(), vMinDate.getDate());
         vNumCols = 0;

         while(Date.parse(vTmpDate) <= Date.parse(vMaxDate))
         {

            var modifiers = '';

            if( JSGantt.formatDateStr(vCurrDate,'mm/dd/yyyy') == JSGantt.formatDateStr(vTmpDate,'mm/dd/yyyy')) {
                modifiers  += " today";
            }

            if(vTmpDate.getDay() % 6 == 0) {
                modifiers  += " weekend";
            }

            strTaskName += '<td class="ghead ' + modifiers + '"><div>' + vTmpDate.getDate() + '</div></td>';

            vItemRowStr += '<td class="ghead ' + modifiers + '"><div>&nbsp;&nbsp;</div></td>';

            vTmpDate.setDate(vTmpDate.getDate() + 1);

         }

         vRightTable += strTaskName + '</TR>';
         vRightTable += '</TBODY></TABLE>';


         for(i = 0; i < vTaskList.length; i++)
         {

            vTmpDate.setFullYear(vMinDate.getFullYear(), vMinDate.getMonth(), vMinDate.getDate());
            vTaskStart = vTaskList[i].getStart();
            vTaskEnd   = vTaskList[i].getEnd();

            vNumCols = 0;
            vID = vTaskList[i].getID();

           // vNumUnits = Math.ceil((vTaskList[i].getEnd() - vTaskList[i].getStart()) / (24 * 60 * 60 * 1000)) + 1;
            vNumUnits = (vTaskList[i].getEnd() - vTaskList[i].getStart()) / (24 * 60 * 60 * 1000) + 1;

            if(vTaskList[i].getVisible() == 0){
                vRightTable += '<DIV id=childgrid_' + vID + ' style="position:relative; display:none;">';
            }
            else{
                vRightTable += '<DIV id=childgrid_' + vID + ' style="position:relative">';
            }

            if( vTaskList[i].getMile()) {

                vRightTable += '<DIV><TABLE style="position:relative; top:0px; width: ' + vChartWidth + 'px;" cellSpacing=0 cellPadding=0 border=0>' +
                '<TR id=childrow_' + vID + ' class=yesdisplay onMouseover=g.mouseOver(this,' + vID + ',"right","mile") onMouseout=g.mouseOut(this,' + vID + ',"right","mile")>' + vItemRowStr + '</TR></TABLE></DIV>';

                strTaskName = JSGantt.formatDateStr(vTaskStart,vDateDisplayFormat);

                vTaskLeft = (Date.parse(vTaskList[i].getStart()) - Date.parse(vMinDate)) / (24 * 60 * 60 * 1000);
                vTaskRight = 1

  	            vRightTable +=
                '<div id=bardiv_' + vID + ' style="position:absolute; top:0px; left:' + Math.ceil((vTaskLeft * (vDayWidth) + 1)) + 'px; height: 18px; width:160px; overflow:hidden;">' +
                '  <div id=taskbar_' + vID + ' title="' + vTaskList[i].getBarname() + ': ' + strTaskName + '" style="height: 16px; width:12px; overflow:hidden; cursor: pointer;" onclick=JSGantt.taskLink("' + vTaskList[i].getLink() + '",300,200);>';

                if(vTaskList[i].getCompVal() < 100){
                    vRightTable += '&loz;</div>' ;
                }
                else{
                    vRightTable += '&diams;</div>' ;
                }

                vCaptionStr = vTaskList[i].getCompStr();
                //vRightTable += '<div style="FONT-SIZE:12px; position:absolute; left: 6px; top:1px;">' + vCaptionStr + '</div>';
                vRightTable += '<div class="caption">' + vCaptionStr + '</div>';

                vRightTable += '</div>';


            }
            else {
                // REB es una tarea normal

                strTaskName = JSGantt.formatDateStr(vTaskStart,vDateDisplayFormat) + ' - ' + JSGantt.formatDateStr(vTaskEnd,vDateDisplayFormat)

                vTaskRight = (Date.parse(vTaskList[i].getEnd()) - Date.parse(vTaskList[i].getStart())) / (24 * 60 * 60 * 1000) + 1/vColUnit;

                vTaskLeft = Math.ceil((Date.parse(vTaskList[i].getStart()) - Date.parse(vMinDate)) / (24 * 60 * 60 * 1000));

                // GRUPO Draw Group Bar  which has outer div with inner group div and several small divs to left and right to create angled-end indicators
                if( vTaskList[i].getGroup()) {
                // #### GRUPO

                    var ribbonfix = 20;

                    vRightTable += '<DIV><TABLE style="position:relative; top:0px; width: ' + vChartWidth + 'px;" cellSpacing=0 cellPadding=0 border=0>' +
                     '<TR id=childrow_' + vID + ' class="yesdisplay ggroup-container" onMouseover=g.mouseOver(this,' + vID + ',"right","group") onMouseout=g.mouseOut(this,' + vID + ',"right","group")>' + vItemRowStr + '</TR></TABLE></DIV>';
                    vRightTable +=
                     '<div class="ggroup-wrapper"  id=bardiv_' + vID + ' style="left:' + Math.ceil(vTaskLeft * (vDayWidth) + 1) + 'px; width:' + Math.ceil((vTaskRight) * (vDayWidth) - 1 + ribbonfix) + 'px">' +
                       '<div id=taskbar_' + vID + ' title="' + vTaskList[i].getBarname() + ': ' + strTaskName + '" class="ggroup" style="width:' + Math.ceil((vTaskRight) * (vDayWidth) -1) + 'px">' +
                         '<div class="completed" style="width:' + vTaskList[i].getCompStr() +'" onclick=JSGantt.taskLink("' + vTaskList[i].getLink() + '",300,200);>' +
                           '</div>' +
                        '</div>';

                    vCaptionStr = vTaskList[i].getCaption(); // getCaption() getResource() getDuration() getCompStr()
                    vRightTable += '<div class="caption" style=" left:' + (Math.ceil((vTaskRight) * (vDayWidth) - 1) + 6) + 'px">' + vCaptionStr + '</div>';

                    vRightTable += '</div>' ;

                }
                else {
                // #### NORMAL

                    vDivStr = '<DIV><TABLE style="position:relative; top:0px; width: ' + vChartWidth + 'px;" cellSpacing=0 cellPadding=0 border=0>' +
                     '<TR id=childrow_' + vID + ' class=yesdisplay bgColor=#ffffff onMouseover=g.mouseOver(this,' + vID + ',"right","row") onMouseout=g.mouseOut(this,' + vID + ',"right","row")>' + vItemRowStr + '</TR></TABLE></DIV>';

                    vRightTable += vDivStr;

                    vRightTable +=
                     '<div class="gtask-container" id=bardiv_' + vID + ' style="left:' + Math.ceil(vTaskLeft * (vDayWidth) + 1) + 'px; width:' + Math.ceil((vTaskRight) * (vDayWidth) - 1) + 'px">' +
                        '<div class="gtask" id=taskbar_' + vID + ' title="' + vTaskList[i].getBarname() + ': ' + strTaskName + '"  style="background-color:#' + vTaskList[i].getColor() +'; width:' + Math.ceil((vTaskRight) * (vDayWidth) - 1) + 'px;" ' +
                           'onclick=JSGantt.taskLink("' + vTaskList[i].getLink() + '",300,200); >' +
                           '<div class=gcomplete style="width:' + vTaskList[i].getCompStr() + '">' +
                           '</div>' +
                        '</div>';

                    vCaptionStr = vTaskList[i].getCaption(); // getCaption() getResource() getDuration() getCompStr()
                    vRightTable += '<div class="caption" style="left:' + (Math.ceil((vTaskRight) * (vDayWidth) - 1) + 6) + 'px">' + vCaptionStr + '</div>';

                    vRightTable += '</div>' ;

                }


            }

            vRightTable += '</DIV>';

        }

        vMainTable += vRightTable + '</DIV></TD></TR></TBODY></TABLE></BODY></HTML>';

        vDiv.innerHTML = vMainTable;

        var width = $('#gantt_td_left').width();
        $('.scroll2').css({'width':width});

      }

   } //this.draw

   this.mouseOver = function( pObj, pID, pPos, pType ) {

      if( pPos == 'right' ){
        vID = 'child_' + pID;
      }
      else{
        vID = 'childrow_' + pID;
      }

      $(pObj).addClass('hover')

      vRowObj = JSGantt.findObj(vID);
      if (vRowObj){
        $(vRowObj).addClass('hover')
      }

   }

   this.mouseOut = function( pObj, pID, pPos, pType ) {
      if( pPos == 'right' ){
        vID = 'child_' + pID;
      }
      else{
        vID = 'childrow_' + pID;
      }

      $(pObj).removeClass('hover')

      vRowObj = JSGantt.findObj(vID);

      if (vRowObj) {
        $(vRowObj).removeClass('hover')

         // if( pType == "group") {
         //    pObj.bgColor = "#f3f3f3";
         //    vRowObj.bgColor = "#f3f3f3";
         // } else {
         //    pObj.bgColor = "#ffffff";
         //    vRowObj.bgColor = "#ffffff";
         // }

      }

   }

} //GanttChart

// Recursively process task tree ... set min, max dates of parent tasks and identfy task level.
JSGantt.processRows = function(pList, pID, pRow, pLevel, pOpen)
{

   var vMinDate = new Date();
   var vMaxDate = new Date();
   var vMinSet  = 0;
   var vMaxSet  = 0;
   var vList    = pList;
   var vLevel   = pLevel;
   var i        = 0;
   var vNumKid  = 0;
   var vCompSum = 0;
   var vVisible = pOpen;

   for(i = 0; i < pList.length; i++)
   {
      if(pList[i].getParent() == pID) {
		 vVisible = pOpen;
         pList[i].setVisible(vVisible);
         if(vVisible==1 && pList[i].getOpen() == 0)
            vVisible = 0;

         pList[i].setLevel(vLevel);
         vNumKid++;

         if(pList[i].getGroup() == 1) {
            JSGantt.processRows(vList, pList[i].getID(), i, vLevel+1, vVisible);
         }

         if( vMinSet==0 || pList[i].getStart() < vMinDate) {
            vMinDate = pList[i].getStart();
            vMinSet = 1;
         }

         if( vMaxSet==0 || pList[i].getEnd() > vMaxDate) {
            vMaxDate = pList[i].getEnd();
            vMaxSet = 1;
         }

         vCompSum += pList[i].getCompVal();

      }
   }

   if(pRow >= 0) {
      pList[pRow].setStart(vMinDate);
      pList[pRow].setEnd(vMaxDate);
      pList[pRow].setNumKid(vNumKid);
      pList[pRow].setCompVal(Math.ceil(vCompSum/vNumKid));
   }

}


// Used to determine the minimum date of all tasks and set lower bound based on format
JSGantt.getMinDate = function getMinDate(pList){

     var vDate = new Date();

     vDate.setFullYear(pList[0].getStart().getFullYear(), pList[0].getStart().getMonth(), pList[0].getStart().getDate());

     // Parse all Task End dates to find min
     for(i = 0; i < pList.length; i++)
     {
        if(Date.parse(pList[i].getStart()) < Date.parse(vDate))
           vDate.setFullYear(pList[i].getStart().getFullYear(), pList[i].getStart().getMonth(), pList[i].getStart().getDate());
     }


    vDate.setDate(vDate.getDate() - 5);


    while(vDate.getDay() % 7 > 0)
    {
        vDate.setDate(vDate.getDate() - 1);
    }



     return(vDate);

}


JSGantt.getMaxDate = function (pList)
{
   var vDate = new Date();

         vDate.setFullYear(pList[0].getEnd().getFullYear(), pList[0].getEnd().getMonth(), pList[0].getEnd().getDate());

                // Parse all Task End dates to find max
         for(i = 0; i < pList.length; i++)
         {
            if(Date.parse(pList[i].getEnd()) > Date.parse(vDate))
            {
                 //vDate.setFullYear(pList[0].getEnd().getFullYear(), pList[0].getEnd().getMonth(), pList[0].getEnd().getDate());
                 vDate.setTime(Date.parse(pList[i].getEnd()));
			}
	     }

        vDate.setDate(vDate.getDate() + 5); // REB le sumo algunos mas

        while(vDate.getDay() % 6 > 0)
        {
            vDate.setDate(vDate.getDate() + 1);
        }

         return(vDate);

}


// This function finds the document id of the specified object
JSGantt.findObj = function (theObj, theDoc){

   var p, i, foundObj;

   if(!theDoc) theDoc = document;

   if( (p = theObj.indexOf("?")) > 0 && parent.frames.length){

        theDoc = parent.frames[theObj.substring(p+1)].document;

        theObj = theObj.substring(0,p);

    }

    if(!(foundObj = theDoc[theObj]) && theDoc.all)

        foundObj = theDoc.all[theObj];



    for (i=0; !foundObj && i < theDoc.forms.length; i++)

        foundObj = theDoc.forms[i][theObj];



    for(i=0; !foundObj && theDoc.layers && i < theDoc.layers.length; i++)

        foundObj = JSGantt.findObj(theObj,theDoc.layers[i].document);



    if(!foundObj && document.getElementById)

        foundObj = document.getElementById(theObj);



return foundObj;

}






      // Function to open/close and hide/show children of specified task

JSGantt.folder= function (pID,ganttObj) {

   var vList = ganttObj.getList();

   for(i = 0; i < vList.length; i++)
   {
      if(vList[i].getID() == pID) {

         if( vList[i].getOpen() == 1 ) {
            vList[i].setOpen(0);
            JSGantt.hide(pID,ganttObj);
            // JSGantt.findObj('group_'+pID).innerHTML = '<i class="fa fa-folder-open"></i>';

            $('#group_'+pID).removeClass('closed').addClass('open').html('<i class="fa fa-folder"></i>');

         } else {

            vList[i].setOpen(1);

            JSGantt.show(pID, 1, ganttObj);
            // JSGantt.findObj('group_'+pID).innerHTML = '<i class="fa fa-folder"></i>';

            $('#group_'+pID).removeClass('open').addClass('closed').html('<i class="fa fa-folder-open"></i>');

         }

      }
   }
}

JSGantt.hide=     function (pID,ganttObj) {
   var vList = ganttObj.getList();
   var vID   = 0;

   for(var i = 0; i < vList.length; i++)
   {
      if(vList[i].getParent() == pID) {
         vID = vList[i].getID();
         JSGantt.findObj('child_' + vID).style.display = "none";
         JSGantt.findObj('childgrid_' + vID).style.display = "none";
         vList[i].setVisible(0);
         if(vList[i].getGroup() == 1)
            JSGantt.hide(vID,ganttObj);
      }

   }
}

// Function to show children of specified task
JSGantt.show =  function (pID, pTop, ganttObj) {
   var vList = ganttObj.getList();
   var vID   = 0;

   for(var i = 0; i < vList.length; i++)
   {
      if(vList[i].getParent() == pID) {
         vID = vList[i].getID();
         if(pTop == 1) {
            if (JSGantt.isIE()) { // IE;

                if($('#group_'+pID).hasClass('open')){
                // if( JSGantt.findObj('group_'+pID).innerText == '+') {
                  JSGantt.findObj('child_'+vID).style.display = "";
                  JSGantt.findObj('childgrid_'+vID).style.display = "";
                  vList[i].setVisible(1);
               }

            } else {

                if($('#group_'+pID).hasClass('open')){

               // if( JSGantt.findObj('group_'+pID).textContent == '+') {
                  JSGantt.findObj('child_'+vID).style.display = "";
                  JSGantt.findObj('childgrid_'+vID).style.display = "";
                  vList[i].setVisible(1);
               }

            }

         } else {

            if (JSGantt.isIE()) { // IE;
                if($('#group_'+pID).hasClass('closed')){
               // if( JSGantt.findObj('group_'+pID).innerText == '–') {
                  JSGantt.findObj('child_'+vID).style.display = "";
                  JSGantt.findObj('childgrid_'+vID).style.display = "";
                  vList[i].setVisible(1);
               }

            } else {

                if($('#group_'+pID).hasClass('closed')){
               // if( JSGantt.findObj('group_'+pID).textContent == '–') {
                  JSGantt.findObj('child_'+vID).style.display = "";
                  JSGantt.findObj('childgrid_'+vID).style.display = "";
                  vList[i].setVisible(1);
               }
            }
         }

         if(vList[i].getGroup() == 1)
            JSGantt.show(vID, 0,ganttObj);

      }
   }
}




JSGantt.taskLink = function(pRef,pWidth,pHeight)

  {

    if(pWidth)  vWidth =pWidth;  else vWidth =400;
    if(pHeight) vHeight=pHeight; else vHeight=400;

    var OpenWindow=window.open(pRef, "newwin", "height="+vHeight+",width="+vWidth);

  }

JSGantt.parseDateStr = function(pDateStr,pFormatStr) {
   var vDate =new Date();
   vDate.setTime( Date.parse(pDateStr));

   switch(pFormatStr)
   {
	  case 'mm/dd/yyyy':
	     var vDateParts = pDateStr.split('/');
         vDate.setFullYear(parseInt(vDateParts[2], 10), parseInt(vDateParts[0], 10) - 1, parseInt(vDateParts[1], 10));
         break;
	  case 'dd/mm/yyyy':
	     var vDateParts = pDateStr.split('/');
         vDate.setFullYear(parseInt(vDateParts[2], 10), parseInt(vDateParts[1], 10) - 1, parseInt(vDateParts[0], 10));
         break;
	  case 'yyyy-mm-dd':
	     var vDateParts = pDateStr.split('-');
         vDate.setFullYear(parseInt(vDateParts[0], 10), parseInt(vDateParts[1], 10) - 1, parseInt(vDateParts[1], 10));
         break;
    }

    return(vDate);

}

JSGantt.formatDateStr = function(pDate,pFormatStr) {
       vYear4Str = pDate.getFullYear() + '';
 	   vYear2Str = vYear4Str.substring(2,4);
       vMonthStr = (pDate.getMonth()+1) + '';
       vDayStr   = pDate.getDate() + '';

      var vDateStr = "";

      switch(pFormatStr) {
	        case 'mm/dd/yyyy':
               return( vMonthStr + '/' + vDayStr + '/' + vYear4Str );
	        case 'dd/mm/yyyy':
               return( vDayStr + '/' + vMonthStr + '/' + vYear4Str );
	        case 'yyyy-mm-dd':
               return( vYear4Str + '-' + vMonthStr + '-' + vDayStr );
	        case 'mm/dd/yy':
               return( vMonthStr + '/' + vDayStr + '/' + vYear2Str );
	        case 'dd/mm/yy':
               return( vDayStr + '/' + vMonthStr + '/' + vYear2Str );
	        case 'yy-mm-dd':
               return( vYear2Str + '-' + vMonthStr + '-' + vDayStr );
	        case 'mm/dd':
               return( vMonthStr + '/' + vDayStr );
	        case 'dd/mm':
               return( vDayStr + '/' + vMonthStr );
      }

}





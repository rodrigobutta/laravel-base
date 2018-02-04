
{{-- {!! Form::open(['url' => route('campaigns.process'), 'method' => 'post', 'pjax-container', 'class' => 'form-horizontal']) !!} --}}

    <input type="hidden" name="campaign_id" value="{{$item->id}}"/>
    <input type="hidden" name="event_id" value="{{$item->event_id}}"/>
    <input type="hidden" name="type_id" value="{{$item->type_id}}"/>

        <div class="form-group row">
            <label class="col-sm-2 control-label">Campaña</label>
            <div class="col-sm-10 text-primary">
               {{$item->name}}
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 control-label">Link</label>
            <div class="col-sm-10 text-primary">
               {{$item->link()}}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12">

              <a class="btn btn-block btn-social btn-facebook">
                <i class="fa fa-facebook"></i> Compartir en Facebook
              </a>
              <a class="btn btn-block btn-social btn-github btn-whatsapp">
                <i class="fa fa-whatsapp"></i> Compartir en WhatsApp
              </a>
           {{--    <a class="btn btn-block btn-social btn-github btn-link">
                <i class="fa fa-external-link-square"></i> Compartir en Link
              </a> --}}
              <a class="btn btn-block btn-social btn-google">
                <i class="fa fa-google-plus"></i> Compartir en Google
              </a>
{{--               <a class="btn btn-block btn-social btn-instagram">
                <i class="fa fa-instagram"></i> Compartir en Instagram
              </a> --}}
              <a class="btn btn-block btn-social btn-linkedin">
                <i class="fa fa-linkedin"></i> Compartir en LinkedIn
              </a>
              <a class="btn btn-block btn-social btn-twitter">
                <i class="fa fa-twitter"></i> Compartir en Twitter
              </a>

{{--
               <div class="btn-group">
                   <a href="#" class="btn btn-info face-share-btn">Compartir</a>
               </div> --}}
            </div>

        </div>


{{-- {!! Form::close() !!} --}}



<script data-exec-on-popstate>

    console.log('Subscript executed..');


    var mobileCheck = false;
      (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) mobileCheck = true;})(navigator.userAgent||navigator.vendor||window.opera);



      window.fbAsyncInit = function() {
        FB.init({
          appId      : '{{ env('FACEBOOK_ID') }}',
          xfbml      : true,
          version    : 'v2.8'
        });
      };

      (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));




    $(function () {




        //SHARES
        $('.btn-facebook').on('click', function(e){
          e.preventDefault;
          var url = '{{$item->link()}}';
          FB.ui({
            method: 'share',
            href: url,
          }, function(response){})
        });

        $('.btn-whatsapp').on('click', function(e){
          e.preventDefault;
          if(mobileCheck) {
            document.location.href = 'whatsapp://send?text={{$item->encodedFullname()}} {{$item->description}} {{$item->link()}}';
          }
          else {
            window.open('https://web.whatsapp.com/send?text={{$item->encodedFullname()}} {{$item->link()}}', '_blank');
          }

        });

        $('.btn-link').on('click', function(e){
          e.preventDefault;
          window.open('{{$item->link()}}', 'linkshare', 'width=975,height=740');
        });

        $('.btn-twitter').on('click', function(e){
          e.preventDefault;
          window.open('https://twitter.com/intent/tweet?text={{$item->link()}}', 'twittshare', 'width=550,height=500');
        });

        $('.btn-linkedin').on('click', function(e){
          e.preventDefault;
          window.open('https://www.linkedin.com/shareArticle?mini=true&url={{$item->link()}}&title={{$item->encodedFullname()}}&summary={{urlencode($item->description)}}&source=LinkedIn', 'linkedintshare', 'width=550,height=500');
        });

        $('.btn-google').on('click', function(e){
          e.preventDefault;
          window.open('https://plus.google.com/share?url={{$item->link()}}', 'linkedintshare', 'width=550,height=500');
        });







    });



</script>
{{-- @extends('admin::index') --}}




<div class="row" >
    <div class="col-md-4 tab-v1 form_builder_general" id="left-tabs">
        <ul class="nav nav-tabs" data-bind="tab: $root.currentTab">
          <li class=""><a href="#add-field-pane" data-toggle="tab" aria-expanded="false">Add New Field</a></li>
          <li class=""><a href="#field-settings-pane" data-toggle="tab" aria-expanded="false">Edit Fields</a></li>
          <li class="active"><a href="#form-settings-pane" data-toggle="tab" aria-expanded="true">Settings</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" id="add-field-pane">
                <div data-bind="template: &#39;tmpl-add-field&#39;">
        <div id="add_a_field" class="add-field-pane" data-bind="click: $root.addField">
            <p>Click to add:</p>
            <button style="font-weight: bold" class="btn btn-default" data-type="name">Name</button>
            <button style="font-weight: bold" class="btn btn-default" data-type="email">Email</button>
            <button style="font-weight: bold" class="btn btn-default" data-type="subject">Subject</button>
            <button style="font-weight: bold" class="btn btn-default" data-type="message">Message</button>
            <div style="margin-top: 15px">
            <button class="btn btn-default" data-type="text">Single Line Text</button>
            <button class="btn btn-default" data-type="number">Number</button>
            <button class="btn btn-default" data-type="textarea">Paragraph Text</button>
            <button class="btn btn-default" data-type="checkbox">Checkboxes</button>
            <button class="btn btn-default" data-type="select">Dropdown</button>
            <button class="btn btn-default" data-type="radio">Radio Buttons</button>
            <button class="btn btn-default" data-type="tel">Telephone #</button>
            <button class="btn btn-default" data-type="url">URL</button>
            <button class="btn btn-default" data-type="date">Date</button>


        </div>
      </div>
    </div>
            </div>
            <div class="tab-pane" id="field-settings-pane">
                <div data-bind="template: {name: &#39;tmpl-field-settings&#39;, data: selectedField }">
      <div data-bind="if: $data"></div>
      <div data-bind="ifnot: $data">
      Click on a field in the "Editor Panel" to edit it.
      </div>
    </div>
            </div>
            <div class="tab-pane active" id="form-settings-pane">
                <div data-bind="template: {name: &#39;tmpl-form&#39;, data: form }">
      <form class="form-stacked extra-settings" data-bind="submit: $.noop">



        <div class="form-group">
          <label class="control-label">Display Name (shown publicly)</label>
          <input class="form-control" name="name" data-bind="value: name">
        </div>

        <div class="form-group">
          <label class="control-label">Description</label>
          <textarea class="form-control" name="description" data-bind="value: description"></textarea>
        </div>
        <div class="form-group">
        <label class="control-label">
              <input type="checkbox" name="hide_intro" data-bind="checked: hide_intro">
              <span>Hide display name and description?</span>
            </label>
        </div>
        <div class="form-group">
            <label class="control-label">Font Size</label>
            <select class="form-control" name="font_size">
                <option value="12">12</option>
                <option value="14" selected="">14</option>
                <option value="16">16</option>
                <option value="18">18</option>
            </select>
        </div>

        <div class="form-group">
            <label class="control-label">Font Family</label>
            <select class="form-control" name="font_family">
                <option value="Arial, Helvetica, sans-serif" selected="">Arial, Helvetica, sans-serif</option>
                <option value="Georgia, serif">Georgia, serif</option>
                <option value="&quot;Palatino Linotype&quot;, &quot;Book Antiqua&quot;, Palatino, serif">"Palatino Linotype", "Book Antiqua", Palatino, serif</option>
                <option value="&quot;Arial Black&quot;, Gadget, sans-serif">"Arial Black", Gadget, sans-serif</option>
                <option value="&quot;Comic Sans MS&quot;, cursive, sans-serif">"Comic Sans MS", cursive, sans-serif</option>
                <option value="Impact, Charcoal, sans-serif">Impact, Charcoal, sans-serif</option>
                <option value="&quot;Lucida Sans Unicode&quot;, &quot;Lucida Grande&quot;, sans-serif">"Lucida Sans Unicode", "Lucida Grande", sans-serif</option>
                <option value="Tahoma, Geneva, sans-serif">Tahoma, Geneva, sans-serif</option>
                <option value="&quot;Courier New&quot;, Courier, monospace">"Courier New", Courier, monospace</option>
                <option value="&quot;Lucida Console&quot;, Monaco, monospace">"Lucida Console", Monaco, monospace</option>
            </select>
        </div>
        <div class="form-group">
          <label class="control-label">Font Color (labels)</label><br>
          <input class="form-control" name="font_color" value="black" style="display: none;"><div class="sp-replacer sp-light"><div class="sp-preview"><div class="sp-preview-inner" style="background-color: rgb(0, 0, 0);"></div></div><div class="sp-dd">▼</div></div>
          </div>
        <div class="form-group">
          <label class="control-label">Submit Button Text</label>
          <input class="form-control" name="submit_text" value="Submit">
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">Submit Button Color</label>
                </div>
                <div class="col-sm-9" style="padding-right: 5px">
                    <select class="form-control" name="button_color">
                        <option value="blue" selected="">Blue (.btn-primary)</option>
                        <option value="white">White (.btn-default)</option>
                        <option value="teal">Teal (.btn-info)</option>
                        <option value="green">Green (.btn-success)</option>
                        <option value="orange">Orange (.btn-warning)</option>
                        <option value="red">Red (.btn-danger)</option>
                        <option value="custom">Custom (.btn-custom)</option>
                    </select>
                </div>
                <div class="col-sm-3 hidden" style="padding-left: 0px; padding-top: 3px;">
                    <input class="form-control" name="button_color_custom" value="#337ab7">

                </div>
            </div>
        </div>
        <div class="form-group">
          <label class="control-label">Submit Button Font Color</label><br>
          <input class="form-control" name="button_font_color" value="white" style="display: none;"><div class="sp-replacer sp-light"><div class="sp-preview"><div class="sp-preview-inner" style="background-color: rgb(255, 255, 255);"></div></div><div class="sp-dd">▼</div></div>
        </div>
        <div class="row">
        <div class="form-group col-sm-6">
            <label class="control-label">Submit Button Size</label>
            <select class="form-control" name="button_size">
                <option value="small">Small</option>
                <option value="medium" selected="">Medium</option>
                <option value="large">Large</option>
                <option value="block">Block</option>
            </select>
        </div>
        <div class="form-group col-sm-6">
            <label class="control-label">Submit Button Style</label>
            <select class="form-control" name="button_style">
                <option value="solid" selected="">Solid</option>
                <option value="outline">Outline</option>
            </select>
        </div>
        </div>
        <div class="form-group">
            <label class="control-label">Label Orientation</label>
            <select class="form-control" name="label_orientation">
                <option value="vertical" selected="">Vertical (Labels above inputs)</option>
                <option value="horizontal">Horizontal (Labels left of inputs)</option>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label">Input Corner Style</label>
            <select class="form-control" name="corner_style">
                <option value="square">Square</option>
                <option value="round" selected="">Rounded (a bit)</option>
                <option value="circle">Round (a lot)</option>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label">Input Size</label>
            <select class="form-control" name="input_size">
                <option value="small">Small</option>
                <option value="medium" selected="">Medium</option>
                <option value="large">Large</option>
            </select>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">Input Focus Color and Glow</label><br>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="pull-left" style="padding-top: 3px;">
                        <input class="form-control" name="focus_color" value="#66afe9" style="display: none;"><div class="sp-replacer sp-light"><div class="sp-preview"><div class="sp-preview-inner" style="background-color: rgb(102, 175, 233);"></div></div><div class="sp-dd">▼</div></div>
                    </div>
                    <div class="pull-left" style="padding-left: 5px;">
                        <select class="form-control" name="focus_glow">
                            <option value="yes" selected="">Glow</option>
                            <option value="no">No Glow</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-sm-6">
                <label class="control-label">Prepend/Append Color</label><br>
                <input class="form-control" name="addon_color" value="#555555" style="display: none;"><div class="sp-replacer sp-light"><div class="sp-preview"><div class="sp-preview-inner" style="background-color: rgb(85, 85, 85);"></div></div><div class="sp-dd">▼</div></div>
            </div>
            <div class="form-group col-sm-6">
                <label class="control-label">...Background Color</label><br>
                <input class="form-control" name="addon_background" value="#eeeeee" style="display: none;"><div class="sp-replacer sp-light"><div class="sp-preview"><div class="sp-preview-inner" style="background-color: rgb(238, 238, 238);"></div></div><div class="sp-dd">▼</div></div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-sm-12">
                <label class="control-label">Extra JavaScript/CSS</label>
                <textarea class="form-control" name="extra_js_css"></textarea>
            </div>
        </div>

      </form>
    </div>
            </div>
        </div>
    </div>
    <div class="col-md-8" data-bind="with: form">
        <div class="tab-v2" id="right-tabs">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_editor" data-toggle="tab" aria-expanded="true">Editor</a></li>
                <li class=""><a href="#tab_preview" data-toggle="tab" aria-expanded="false">Preview</a></li>
            </ul>
            <div class="tab-content" style="padding-left: 0; padding-right: 0;">


                <div class="tab-pane form_builder_general active" id="tab_editor" style="margin-left: 15px; margin-right: 15px;">
                    <span data-bind="ifnot: hide_intro"></span>
                    <form data-bind="sortable: {template: &#39;tmpl-field-preview&#39;, data: fields}" class="form-stacked form-builder-preview ko_container ui-sortable"></form>
                    <div data-bind="ifnot: hasFields"></div>
                    <script type="text/html" id="tmpl-form">
      <form  class="form-stacked extra-settings" data-bind="submit: $.noop">



        <div class="form-group">
          <label class="control-label">Display Name (shown publicly)</label>
          <input class="form-control" name="name" data-bind="value: name">
        </div>

        <div class="form-group">
          <label class="control-label">Description</label>
          <textarea class="form-control" name="description"  data-bind="value: description"></textarea>
        </div>
        <div class="form-group">
        <label class="control-label">
              <input type="checkbox" name="hide_intro" data-bind="checked: hide_intro">
              <span>Hide display name and description?</span>
            </label>
        </div>
        <div class="form-group">
            <label class="control-label">Font Size</label>
            <select class="form-control" name="font_size" >
                <option value="12" >12</option>
                <option value="14" selected>14</option>
                <option value="16" >16</option>
                <option value="18" >18</option>
            </select>
        </div>

        <div class="form-group">
            <label class="control-label">Font Family</label>
            <select class="form-control" name="font_family">
                <option value='Arial, Helvetica, sans-serif'selected>Arial, Helvetica, sans-serif</option>
                <option value='Georgia, serif' >Georgia, serif</option>
                <option value='"Palatino Linotype", "Book Antiqua", Palatino, serif' >"Palatino Linotype", "Book Antiqua", Palatino, serif</option>
                <option value='"Arial Black", Gadget, sans-serif' >"Arial Black", Gadget, sans-serif</option>
                <option value='"Comic Sans MS", cursive, sans-serif' >"Comic Sans MS", cursive, sans-serif</option>
                <option value='Impact, Charcoal, sans-serif' >Impact, Charcoal, sans-serif</option>
                <option value='"Lucida Sans Unicode", "Lucida Grande", sans-serif' >"Lucida Sans Unicode", "Lucida Grande", sans-serif</option>
                <option value='Tahoma, Geneva, sans-serif' >Tahoma, Geneva, sans-serif</option>
                <option value='"Courier New", Courier, monospace' >"Courier New", Courier, monospace</option>
                <option value='"Lucida Console", Monaco, monospace' >"Lucida Console", Monaco, monospace</option>
            </select>
        </div>
        <div class="form-group">
          <label class="control-label">Font Color (labels)</label><br />
          <input class="form-control" name="font_color" value="black">
          </div>
        <div class="form-group">
          <label class="control-label">Submit Button Text</label>
          <input class="form-control" name="submit_text" value="Submit">
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">Submit Button Color</label>
                </div>
                <div class="col-sm-9" style="padding-right: 5px">
                    <select  class="form-control" name="button_color">
                        <option value="blue" selected>Blue (.btn-primary)</option>
                        <option value="white" >White (.btn-default)</option>
                        <option value="teal" >Teal (.btn-info)</option>
                        <option value="green" >Green (.btn-success)</option>
                        <option value="orange" >Orange (.btn-warning)</option>
                        <option value="red" >Red (.btn-danger)</option>
                        <option value="custom" >Custom (.btn-custom)</option>
                    </select>
                </div>
                <div class="col-sm-3 hidden" style="padding-left: 0px; padding-top: 3px;" >
                    <input class="form-control" name="button_color_custom" value="#337ab7">
                </a>
                </div>
            </div>
        </div>
        <div class="form-group">
          <label class="control-label">Submit Button Font Color</label><br />
          <input class="form-control" name="button_font_color" value="white">
        </div>
        <div class="row">
        <div class="form-group col-sm-6">
            <label class="control-label">Submit Button Size</label>
            <select  class="form-control" name="button_size">
                <option value="small" >Small</option>
                <option value="medium" selected>Medium</option>
                <option value="large" >Large</option>
                <option value="block" >Block</option>
            </select>
        </div>
        <div class="form-group col-sm-6">
            <label class="control-label">Submit Button Style</label>
            <select  class="form-control" name="button_style">
                <option value="solid" selected>Solid</option>
                <option value="outline" >Outline</option>
            </select>
        </div>
        </div>
        <div class="form-group">
            <label class="control-label">Label Orientation</label>
            <select  class="form-control" name="label_orientation">
                <option value="vertical" selected>Vertical (Labels above inputs)</option>
                <option value="horizontal" >Horizontal (Labels left of inputs)</option>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label">Input Corner Style</label>
            <select  class="form-control" name="corner_style">
                <option value="square" >Square</option>
                <option value="round" selected>Rounded (a bit)</option>
                <option value="circle" >Round (a lot)</option>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label">Input Size</label>
            <select  class="form-control" name="input_size">
                <option value="small" >Small</option>
                <option value="medium" selected>Medium</option>
                <option value="large" >Large</option>
            </select>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">Input Focus Color and Glow</label><br />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="pull-left" style="padding-top: 3px;">
                        <input class="form-control" name="focus_color" value="#66afe9">
                    </div>
                    <div class="pull-left" style="padding-left: 5px;">
                        <select  class="form-control" name="focus_glow">
                            <option value="yes" selected>Glow</option>
                            <option value="no" >No Glow</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-sm-6">
                <label class="control-label">Prepend/Append Color</label><br />
                <input class="form-control" name="addon_color" value="#555555">
            </div>
            <div class="form-group col-sm-6">
                <label class="control-label">...Background Color</label><br />
                <input class="form-control" name="addon_background" value="#eeeeee">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-sm-12">
                <label class="control-label">Extra JavaScript/CSS</label>
                <textarea class="form-control" name="extra_js_css"></textarea>
            </div>
        </div>

      </form>
    </script>

    <!-- Add Field Pane -->
    <script type="text/html" id="tmpl-add-field">
        <div id="add_a_field" class="add-field-pane" data-bind="click: $root.addField">
            <p>Click to add:</p>
            <button style="font-weight: bold" class="btn btn-default" data-type="name">Name</button>
            <button style="font-weight: bold" class="btn btn-default" data-type="email">Email</button>
            <button style="font-weight: bold" class="btn btn-default" data-type="subject">Subject</button>
            <button style="font-weight: bold" class="btn btn-default" data-type="message">Message</button>
            <div style="margin-top: 15px">
            <button class="btn btn-default" data-type="text">Single Line Text</button>
            <button class="btn btn-default" data-type="number">Number</button>
            <button class="btn btn-default" data-type="textarea">Paragraph Text</button>
            <button class="btn btn-default" data-type="checkbox">Checkboxes</button>
            <button class="btn btn-default" data-type="select">Dropdown</button>
            <button class="btn btn-default" data-type="radio">Radio Buttons</button>
            <button class="btn btn-default" data-type="tel">Telephone #</button>
            <button class="btn btn-default" data-type="url">URL</button>
            <button class="btn btn-default" data-type="date">Date</button>


        </div>
      </div>
    </script>

    <!-- Generic field preview template -->
    <script type="text/html" id="tmpl-field-preview">
        <div class="clearfix field-wrapper click_on_field"
           data-bind="click: $root.selectField,
                      css: { selected: $data == $root.selectedField() },
                      sortableItem: $data">
            <div class="row">
                <div class="form-group col-md-10">
                    <label>
                        <span data-bind="if: is_required" class="required">*</span>
                        <span data-bind="text: title"></span>
                    </label>
                    <span data-bind="template: previewTemplateName"></span> <!-- cjy where the actual input goes -->
                    <span data-bind="text: instructions == '' ? '' : instructions " class="help-block"></span>
                </div>
                <div class="col-md-2" style="margin-top: 28px">
                  <button data-bind="click: $root.removeField" class="btn xsmall btn-default"><span style="color: #d9534f" class="fa fa-minus"></span></button>
                </div>
                <div class="clearfix"></div>
            </div>

        </div>
    </script>

    <!-- Generic field settings template -->
    <script type="text/html" id="tmpl-field-settings">
      <div data-bind="if: $data">
        <form class="form-stacked">
        <div class="form-group">
            <label class="control-label">Title</label>
            <textarea class="form-control" data-bind="value: title" class="xlarge"></textarea>
          </div>
        <div class="form-group">
            <label class="control-label">Type: <span style="font-weight: normal" data-bind="text: type"></span></label>
              <!--<select data-bind="options: FIELD_TYPES, value: type"></select>-->
          </div>

        <div class="form-group">
            <label class="control-label">
              <input type="checkbox" data-bind="checked: is_required">
                      Required?
            </label>

        </div>
        <div data-bind="if: inlineNeeded" class="form-group">
            <label class="control-label">
              <input type="checkbox" data-bind="checked: inline">
              Display Inline?
            </label>
        </div>
        <div class="form-group">
            <label class="control-label">Instructions</label>
            <textarea class="form-control" data-bind="value: instructions"></textarea>
          </div>
        <div data-bind="if: placeholderNeeded" class="form-group">
            <label class="control-label">Placeholder</label>
              <input class="form-control" data-bind="value: placeholder">
        </div>

        <div class="form-group">
            <label class="control-label">Unique Identifier (name/id)</label>
            <input class="form-control" data-bind="value: id_name">
        </div>

        <div class="row" data-bind="if: addonsNeeded">
            <div class="col-sm-12">
                <label class="control-label">Prepend</label>
            </div>
            <div class="form-group col-sm-4">
               <select class="select form-control" name="prepend" data-bind="options: prepend_array, value: prepend"></select>
            </div>
            <div class="form-group col-sm-8">
                <div class="input-group" data-bind="visible: show_prepend_icon">
                    <input type="text" class="form-control" data-bind="value: prepend_icon" name="prepend_icon">
                    <span class="input-group-addon"></span>
                </div>
                <input type="text" class="form-control" data-bind="visible: show_prepend_text, value: prepend_text" name="prepend_text">
            </div>
        </div>

        <div class="row" data-bind="if: addonsNeeded">
            <div class="col-sm-12">
                <label class="control-label">Append</label>
            </div>
            <div class="form-group col-sm-4">
                <select class="select form-control" name="append" data-bind="options: append_array, value: append"></select>
            </div>
            <div class="form-group col-sm-8">
                <input type="text" class="form-control" data-bind="visible: show_append_text, value: append_text" name="append_text">
                <div class="input-group" data-bind="visible: show_append_icon">
                    <input type="text" class="form-control" data-bind="value: append_icon" name="append_icon">
                    <span class="input-group-addon"></span>
                </div>
            </div>
        </div>

        <div data-bind="template: settingsTemplateName"></div>
        </form>
      </div>
      <div data-bind="ifnot: $data">
      Click on a field in the "Editor Panel" to edit it.
      </div>
    </script>

    <!-- Radio field -->
    <script type="text/html" id="tmp-field-preview-radio">
      <ul data-bind="foreach: choices" class="unstyled">
        <label>
          <input type="radio" data-bind="attr: {name: $parent.FieldId}" disabled readonly>
          <span data-bind="text: choice"></span>
        </label>
      </ul>
    </script>
    <script type="text/html" id="tmp-field-settings-radio">
      <div data-bind="template: 'tmp-choices', data: $data"></div>
    </script>

    <!-- Number field -->
    <script type="text/html" id="tmp-field-preview-number">
      <input class="xlarge form-control" data-bind="attr: {placeholder: placeholder}" />
    </script>
    <script type="text/html" id="tmp-field-settings-number"></script>

    <!-- Subject field -->
    <script type="text/html" id="tmp-field-preview-subject">
      <input class="xlarge form-control" data-bind="attr: {placeholder: placeholder}" />
    </script>
    <script type="text/html" id="tmp-field-settings-subject"></script>

    <!-- URL field -->
    <script type="text/html" id="tmp-field-preview-url">
      <input class="xlarge form-control" data-bind="attr: {placeholder: placeholder}" />
    </script>
    <script type="text/html" id="tmp-field-settings-url"></script>

    <!-- Telephone field -->
    <script type="text/html" id="tmp-field-preview-tel">
      <input class="xlarge form-control" data-bind="attr: {placeholder: placeholder}" />
    </script>
    <script type="text/html" id="tmp-field-settings-tel"></script>

    <!-- Date Field field -->
    <script type="text/html" id="tmp-field-preview-date">
      <input class="xlarge form-control" data-bind="attr: {placeholder: placeholder}" />
    </script>
    <script type="text/html" id="tmp-field-settings-date"></script>

    <!-- Name field -->
    <script type="text/html" id="tmp-field-preview-name">
      <input class="xlarge form-control" data-bind="attr: {placeholder: placeholder}" />
    </script>
    <script type="text/html" id="tmp-field-settings-name"></script>

    <!-- Text field -->
    <script type="text/html" id="tmp-field-preview-text">
      <input class="xlarge form-control" data-bind="attr: {placeholder: placeholder}" />
    </script>

    <script type="text/html" id="tmp-field-settings-text"></script>

    <!-- Checkboxes field -->
    <script type="text/html" id="tmp-field-preview-checkbox">
      <ul data-bind="foreach: choices" class="unstyled">
        <label>
          <input type="checkbox" data-bind="attr: {name: $parent.FieldId}" disabled readonly>
          <span data-bind="text: choice"></span>
        </label>
      </ul>
    </script>
    <script type="text/html" id="tmp-field-settings-checkbox">
      <div data-bind="template: 'tmp-choices', data: $data"></div>
    </script>

    <!-- Textarea field -->
    <script type="text/html" id="tmp-field-preview-textarea">
      <textarea class="xlarge form-control"></textarea>
    </script>
    <script type="text/html" id="tmp-field-settings-textarea"></script>

    <!-- Message field -->
    <script type="text/html" id="tmp-field-preview-message">
      <textarea class="xlarge form-control"></textarea>
    </script>
    <script type="text/html" id="tmp-field-settings-message"></script>

    <!-- File field -->
    <script type="text/html" id="tmp-field-preview-file">
      <input type="file">
    </script>
    <script type="text/html" id="tmp-field-settings-file"></script>

    <!-- Email field -->
    <script type="text/html" id="tmp-field-preview-email">
      <input class="xlarge form-control" data-bind="attr: {placeholder: placeholder}" />
    </script>
    <script type="text/html" id="tmp-field-settings-email"></script>

    <!-- Phone field -->
    <script type="text/html" id="tmp-field-preview-phone">
      <input class="large form-control">
    </script>
    <script type="text/html" id="tmp-field-settings-phone"></script>

    <!-- Select field -->
    <script type="text/html" id="tmp-field-preview-select">
      <select class="form-control" data-bind="options: choices, optionsText: 'choice'"></select>
    </script>
    <script type="text/html" id="tmp-field-settings-select">
      <div data-bind="template: 'tmp-choices', data: $data"></div>
    </script>

    <!-- URL field -->
    <script type="text/html" id="tmp-field-preview-url">
      <input class="large form-control">
    </script>
    <script type="text/html" id="tmp-field-settings-url"></script>

    <!-- Helpers -->
    <script type="text/html" id="tmp-choices">
      <div class="clearfix">
        <label>Choices</label>
        <ul data-bind="foreach: choices" class="list-unstyled"s>
          <li>
            <div class="form-group">
                <input class="form-control" style="width: auto; display: inline" data-bind="value: choice" class="">
                <button data-bind="click: $parent.addChoice" class="btn xsmall btn-default" style="border: none"><span style="color: #5cb85c;" class=" fa fa-plus"></button>
                <button data-bind="click: $parent.removeChoice" class="xsmall btn btn-default" style="border: none"><span style="color: #d9534f" class="fa fa-minus"></span></button>
            </div>
          </li>
        </ul>
        <div data-bind="ifnot: hasChoices">
          <button data-bind="click: addChoice" class="btn small btn-default">+ Add a Choice</button>
        </div>
      </div>
    </script>

                </div>

                <div class="tab-pane" id="tab_preview">

                </div>
            </div>
        </div>
    </div>
</div> <!-- end row -->




<script>

(function($){
   $.fn.innerText = function(msg) {
         if (msg) {
            if (document.body.innerText) {
               for (var i in this) {
                  this[i].innerText = msg;
               }
            } else {
               for (var i in this) {
                  this[i].innerHTML.replace(/&amp;lt;br&amp;gt;/gi,"n").replace(/(&amp;lt;([^&amp;gt;]+)&amp;gt;)/gi, "");
               }
            }
            return this;
         } else {
            if (document.body.innerText) {
               return this[0].innerText;
            } else {
               return this[0].innerHTML.replace(/&amp;lt;br&amp;gt;/gi,"n").replace(/(&amp;lt;([^&amp;gt;]+)&amp;gt;)/gi, "");
            }
         }
   };
})(jQuery);




</script>






<script>

$( document ).ready(function() {


var form_settings_pane=$("a[href='#form-settings-pane']");
form_settings_pane.click(function(){
    spectrum_attrs={
        preferredFormat: "hex",
        showInput: true
    }
    var font_color=$("[name='font_color']");
    var button_font_color=$("[name='button_font_color']");
    var button_color_custom=$("[name='button_color_custom']");
    var focus_color=$("[name='focus_color']");
    var button_color=$("[name='button_color']");
    var button_style=$("select[name='button_style']");
    var addon_color=$("[name='addon_color']");
    var addon_background=$("[name='addon_background']");


    font_color.spectrum(spectrum_attrs);
    button_font_color.spectrum(spectrum_attrs);
    focus_color.spectrum(spectrum_attrs);
    addon_color.spectrum(spectrum_attrs);
    addon_background.spectrum(spectrum_attrs);



    function update_button_color_custom(){
        var value=button_color.val();
        if (value == 'custom'){
            button_color_custom.parent().removeClass("hidden");
            button_color_custom.spectrum(spectrum_attrs);
        }
        else{
            button_color_custom.parent().addClass("hidden");
        }
    }

    update_button_color_custom();
    button_color.change(function() {
        update_button_color_custom();
    });

    button_color.change(function() {
        update_button_colors();
    });

    button_style.change(function() {
        update_button_colors();
    });

    button_color_custom.change(function() {
        update_button_colors();
    });


    function update_button_colors(){
        var color_map={'blue':'#337ab7', 'teal':'#31b0d5', 'white': '#ffffff', 'orange': '#f0ad4e', 'red':'#d9534f', 'green': '#5cb85c', 'custom': 'custom'}
        var button_style_val=$("select[name='button_style']").val();
        var button_color_val=color_map[button_color.val()];
        var button_color_custom_val=button_color_custom.val();
        var button_font_color_val=button_font_color.val();
        if (button_style_val=='outline'){
            if (button_color_val == 'custom'){
                button_font_color.val(button_color_custom_val);
            }
            else{
                if (button_color_val == '#ffffff'){
                    button_font_color.val('#000000');
                }
                else{
                    button_font_color.val(button_color_val);
                }
            }
        }
        else{ //if solid
            if (button_color_val != 'custom'){ //and not custom
                if (button_color_val == '#ffffff'){
                    button_font_color.val('#000000');
                }
                else{
                    button_font_color.val('#ffffff');
                }
            }
        }
        button_font_color.spectrum(spectrum_attrs);
    }

})






})


</script>



<script type="text/javascript">
//<![CDATA[
$( document ).ready(function() {
    $('[data-toggle="popover"]').popover({'html': true})
});
var initial_form={"button_font_color": "white", "addon_color": "#555555", "recipient_email": "", "submit_text": "Submit", "corner_style": "round", "nickname": "Contact Form", "button_style": "solid", "button_size": "medium", "hide_intro": true, "input_size": "medium", "font_family": "Arial, Helvetica, sans-serif", "description": "", "form": null, "button_color": "blue", "focus_color": "#66afe9", "extra_js_css": "", "label_orientation": "vertical", "addon_background": "#eeeeee", "font_size": "14", "name": "Contact Form", "fields": [{"title": "Name", "placeholder": "", "choices": [], "id_name": "name", "inline": false, "is_required": false, "type": "name", "id": 1, "instructions": ""}, {"title": "Email", "placeholder": "", "choices": [], "id_name": "email", "inline": false, "is_required": true, "type": "email", "id": 2, "instructions": ""}, {"title": "Subject", "placeholder": "", "choices": [], "id_name": "subject", "inline": false, "is_required": false, "type": "subject", "id": 3, "instructions": ""}, {"title": "Message", "placeholder": "", "choices": [], "id_name": "message", "inline": false, "is_required": false, "type": "message", "id": 4, "instructions": ""}], "button_color_custom": "#337ab7", "font_color": "black", "focus_glow": "yes"};
//]]
</script>

<!--[if lt IE 9]>
    <script src="/static/assets/plugins/respond.js"></script>
<![endif]-->


    <div class="sp-container sp-hidden sp-light sp-palette-buttons-disabled sp-palette-disabled sp-initial-disabled" style="position: absolute; top: 0px; left: 0px;"><div class="sp-palette-container"><div class="sp-palette sp-thumb sp-cf"></div><div class="sp-palette-button-container sp-cf"><button type="button" class="sp-palette-toggle">less</button></div></div><div class="sp-picker-container"><div class="sp-top sp-cf"><div class="sp-fill"></div><div class="sp-top-inner"><div class="sp-color" style="background-color: rgb(255, 0, 0);"><div class="sp-sat"><div class="sp-val"><div class="sp-dragger" style="display: block; top: 0px; left: 0px;"></div></div></div></div><div class="sp-clear sp-clear-display" title="Clear Color Selection" style="display: none;"></div><div class="sp-hue"><div class="sp-slider" style="display: block; top: 0px;"></div></div></div><div class="sp-alpha"><div class="sp-alpha-inner"><div class="sp-alpha-handle" style="display: block; left: 0px;"></div></div></div></div><div class="sp-input-container sp-cf"><input class="sp-input" type="text" spellcheck="false"></div><div class="sp-initial sp-thumb sp-cf"></div><div class="sp-button-container sp-cf"><a class="sp-cancel" href="#">cancel</a><button type="button" class="sp-choose">choose</button></div></div></div><div class="sp-container sp-hidden sp-light sp-palette-buttons-disabled sp-palette-disabled sp-initial-disabled" style="position: absolute; top: 0px; left: 0px;"><div class="sp-palette-container"><div class="sp-palette sp-thumb sp-cf"></div><div class="sp-palette-button-container sp-cf"><button type="button" class="sp-palette-toggle">less</button></div></div><div class="sp-picker-container"><div class="sp-top sp-cf"><div class="sp-fill"></div><div class="sp-top-inner"><div class="sp-color" style="background-color: rgb(255, 0, 0);"><div class="sp-sat"><div class="sp-val"><div class="sp-dragger" style="display: block; top: 0px; left: 0px;"></div></div></div></div><div class="sp-clear sp-clear-display" title="Clear Color Selection" style="display: none;"></div><div class="sp-hue"><div class="sp-slider" style="display: block; top: 0px;"></div></div></div><div class="sp-alpha"><div class="sp-alpha-inner"><div class="sp-alpha-handle" style="display: block; left: 0px;"></div></div></div></div><div class="sp-input-container sp-cf"><input class="sp-input" type="text" spellcheck="false"></div><div class="sp-initial sp-thumb sp-cf"></div><div class="sp-button-container sp-cf"><a class="sp-cancel" href="#">cancel</a><button type="button" class="sp-choose">choose</button></div></div></div><div class="sp-container sp-hidden sp-light sp-palette-buttons-disabled sp-palette-disabled sp-initial-disabled" style="position: absolute; top: 0px; left: 0px;"><div class="sp-palette-container"><div class="sp-palette sp-thumb sp-cf"></div><div class="sp-palette-button-container sp-cf"><button type="button" class="sp-palette-toggle">less</button></div></div><div class="sp-picker-container"><div class="sp-top sp-cf"><div class="sp-fill"></div><div class="sp-top-inner"><div class="sp-color" style="background-color: rgb(0, 142, 255);"><div class="sp-sat"><div class="sp-val"><div class="sp-dragger" style="display: block; top: 0px; left: 0px;"></div></div></div></div><div class="sp-clear sp-clear-display" title="Clear Color Selection" style="display: none;"></div><div class="sp-hue"><div class="sp-slider" style="display: block; top: 0px;"></div></div></div><div class="sp-alpha"><div class="sp-alpha-inner"><div class="sp-alpha-handle" style="display: block; left: 0px;"></div></div></div></div><div class="sp-input-container sp-cf"><input class="sp-input" type="text" spellcheck="false"></div><div class="sp-initial sp-thumb sp-cf"></div><div class="sp-button-container sp-cf"><a class="sp-cancel" href="#">cancel</a><button type="button" class="sp-choose">choose</button></div></div></div><div class="sp-container sp-hidden sp-light sp-palette-buttons-disabled sp-palette-disabled sp-initial-disabled" style="position: absolute; top: 0px; left: 0px;"><div class="sp-palette-container"><div class="sp-palette sp-thumb sp-cf"></div><div class="sp-palette-button-container sp-cf"><button type="button" class="sp-palette-toggle">less</button></div></div><div class="sp-picker-container"><div class="sp-top sp-cf"><div class="sp-fill"></div><div class="sp-top-inner"><div class="sp-color" style="background-color: rgb(255, 0, 0);"><div class="sp-sat"><div class="sp-val"><div class="sp-dragger" style="display: block; top: 0px; left: 0px;"></div></div></div></div><div class="sp-clear sp-clear-display" title="Clear Color Selection" style="display: none;"></div><div class="sp-hue"><div class="sp-slider" style="display: block; top: 0px;"></div></div></div><div class="sp-alpha"><div class="sp-alpha-inner"><div class="sp-alpha-handle" style="display: block; left: 0px;"></div></div></div></div><div class="sp-input-container sp-cf"><input class="sp-input" type="text" spellcheck="false"></div><div class="sp-initial sp-thumb sp-cf"></div><div class="sp-button-container sp-cf"><a class="sp-cancel" href="#">cancel</a><button type="button" class="sp-choose">choose</button></div></div></div><div class="sp-container sp-hidden sp-light sp-palette-buttons-disabled sp-palette-disabled sp-initial-disabled" style="position: absolute; top: 0px; left: 0px;"><div class="sp-palette-container"><div class="sp-palette sp-thumb sp-cf"></div><div class="sp-palette-button-container sp-cf"><button type="button" class="sp-palette-toggle">less</button></div></div><div class="sp-picker-container"><div class="sp-top sp-cf"><div class="sp-fill"></div><div class="sp-top-inner"><div class="sp-color" style="background-color: rgb(255, 0, 0);"><div class="sp-sat"><div class="sp-val"><div class="sp-dragger" style="display: block; top: 0px; left: 0px;"></div></div></div></div><div class="sp-clear sp-clear-display" title="Clear Color Selection" style="display: none;"></div><div class="sp-hue"><div class="sp-slider" style="display: block; top: 0px;"></div></div></div><div class="sp-alpha"><div class="sp-alpha-inner"><div class="sp-alpha-handle" style="display: block; left: 0px;"></div></div></div></div><div class="sp-input-container sp-cf"><input class="sp-input" type="text" spellcheck="false"></div><div class="sp-initial sp-thumb sp-cf"></div><div class="sp-button-container sp-cf"><a class="sp-cancel" href="#">cancel</a><button type="button" class="sp-choose">choose</button></div></div></div></body></html>
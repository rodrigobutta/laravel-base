
(function(window, document, undefined) {
    'use strict';
    (function(factory) {
        if (typeof define === 'function' && define.amd) {
            // Register as an anonymous AMD module.
            define(['jquery'], factory);
        } else if (typeof exports === 'object') {
            // Node/CommonJS
            module.exports = factory(require('jquery'));
        } else {
            // Browser globals
            factory(window.jQuery);
        }
    }(function($) {
        // Create the defaults once
        var pluginName = 'livingDialog';
        var pluginClass = 'living-dialog';
        var pluginType = 'living.dialog';
        var defaults = {
            container: null,
            selector: false, // jQuery selector, if a selector is provided, popover objects will be delegated to the specified.
            open: {
                type: 'GET',
                before: null, //function(that, xhr){}
                predata: null // pasar parametros especificos para abrir el formulario function(el){}
            },
            error: null, //function(that, xhr, data){}
            opened: null, // el dialogo se abrio function(that, xhr){}
            closed: null, // el dialogo se cerro (por submit o por tocar en el overlay) function(that){}
            submited: null // el formulario se envio y se recibio respuesta ajaxfunction(that, data, response){}
        };

        var _srcElements = [];
        var $document = $(document);
        var modalContent = null;
        var form = null;


        // The actual plugin constructor
        function LivingDialog(element, options) {
            this.$element = $(element);
            this.options = $.extend({}, defaults, options);
            this._defaults = defaults;
            this._name = pluginName;
            this.init();
            _srcElements.push(this.$element);
            return this;

        }

        LivingDialog.prototype = {
            //init webui popover
            init: function() {
                if (this.$element[0] instanceof document.constructor && !this.options.selector) {
                    throw new Error('`selector` option must be specified when initializing ' + this.type + ' on the window.document object!');
                }

                this.id = pluginName;

                var that = this;

                $.ajax({
                    type: 'GET',
                    url: this.getUrl(),
                    success: function(data) {

                      that.$element.find(".modal-body").html(data);
                      that.$element.modal('show');

                      that.$element.on('hidden.bs.modal', function () {
                        that.closing();
                      })


                      that.modalContent = that.$element.find(".modal-body");



                      that.modalContent.find('form').submit(function(e) {
                          e.preventDefault();

                          that.form = $(this);

                          var tmpSerialize = that.form.serialize();

                          console.log('form submit!!!!')

                          $.ajax({
                              type: 'POST',
                              url: that.form.attr('action'),
                              data: tmpSerialize,
                              // dataType: 'json',
                              cache: false,
                              success: function( response ) {
                                console.log('success');

                                that.submited(response);

                                that.$element.modal('hide');

                              },
                              error: function(response) {
                                console.log('livedialog submit fail');

                                if (that.options.error) {
                                    that.options.error('ajax form submit', that, tmpSerialize, response);
                                }

                              }
                          });



                          return false;
                      });


                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {

                          if (that.options.error) {
                              that.options.error('ajax form load 2', that, XMLHttpRequest, textStatus);
                          }

                    }
                });


                console.log(this.$element)

            },

            submited: function(response) {

                var fields = this.formToJson();

                if (this.options.submited) {
                    this.options.submited(fields,response);
                }

            },

            closing: function() {

                if (this.options.closed) {
                    this.options.closed(this);
                }

                this.destroy();

            },

            destroy: function() {
                var index = -1;

                for (var i = 0; i < _srcElements.length; i++) {
                    if (_srcElements[i] === this.$element) {
                        index = i;
                        break;
                    }
                }

                _srcElements.splice(index, 1);

                this.$element.data('plugin_' + pluginName, null);

                if (this.$target) {
                    this.$target.remove();
                }
            },

            formToJson: function() {

                var unindexed_array = this.form.serializeArray();
                var indexed_array = {};

                $.map(unindexed_array, function(n, i){
                    indexed_array[n['name']] = n['value'];
                });

                return indexed_array;

            },

            getData: function() { // reb funcion para parametrizar el data
                var el = this.$element;
                var res = this.options.open.predata(el);
                return res;
            },
            getTrigger: function() {
                return this.$element.attr('data-trigger') || this.options.trigger;
            },

            setContentASync: function(content) {
                var that = this;
                if (this.xhr) {
                    return;
                }
                this.xhr = $.ajax({
                    url: this.getUrl(),
                    type: this.options.open.type,
                    data: this.getData(),
                    beforeSend: function(xhr, settings) {
                        if (that.options.open.before) {
                            that.options.open.before(that, xhr);
                        }
                    },
                    success: function(data) {
                        that.bindBodyEvents();
                        if (content && $.isFunction(content)) {
                            that.content = content.apply(that.$element[0], [data]);
                        } else {
                            that.content = data;
                        }
                        that.setContent(that.content);
                        var $targetContent = that.getContentElement();
                        $targetContent.removeAttr('style');
                        that.displayContent();
                        if (that.options.opened) {
                            that.options.opened(that, data);
                        }
                    },
                    complete: function() {
                        that.xhr = null;
                    },
                    error: function(xhr, data) {
                        if (that.options.error) {
                            that.options.error('ajax form load', that, xhr, data);
                        }
                    }
                });
            },

            getUrl: function() {
                return this.$element.attr('data-url') || this.options.url;
            },



        };
        $.fn[pluginName] = function(options, noInit) {
            var results = [];
            var $result = this.each(function() {

                var livingDialog = $.data(this, 'plugin_' + pluginName);
                if (!livingDialog) {
                    if (!options) {
                        livingDialog = new LivingDialog(this, null);
                    } else if (typeof options === 'string') {
                        if (options !== 'destroy') {
                            if (!noInit) {
                                livingDialog = new LivingDialog(this, null);
                                results.push(livingDialog[options]());
                            }
                        }
                    } else if (typeof options === 'object') {
                        livingDialog = new LivingDialog(this, options);
                    }
                    $.data(this, 'plugin_' + pluginName, livingDialog);
                } else {
                    if (options === 'destroy') {
                        livingDialog.destroy();
                    } else if (typeof options === 'string') {
                        results.push(livingDialog[options]());
                    }
                }
            });
            return (results.length) ? results : $result;
        };


    }));
})(window, document);



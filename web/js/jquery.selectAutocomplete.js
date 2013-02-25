/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


(function( $ ) {
    Array.prototype.unique=function(a){
        return function(){return this.filter(a)}}(function(a,b,c){return c.indexOf(a,b+1)<0
    });
    $.widget( "ui.sac", {
        options: {
            load: '',
            join: ', ',
            minLength: 0,
            onSelect: function(opt, event){},
            onLoad: function(){},
            onCreate: function(){},
            onClick: function(){},
            onFocus: function(){},
            onChange: function(){},
            onRefresh: function(){},
            onRecharge: function(){},
            open: function(){},
            beforeOpen: function(){}
        },
        _refresh: function(){
            this.options.onRefresh()
        },
        recharge: function(){
            this.input.autocomplete('destroy')
            this.createInput()
            this.options.onRecharge()
            this.open()
        },
        getSelect: function(){
            return this.element
        },
        // events bound via _on are removed automatically
        // revert other modifications here
        _destroy: function() {
            this.wrapper.remove();
            this.element.show();
        },

        // _setOptions is called with a hash of all options that are changing
        // always refresh when changing options
        _setOptions: function() {
            // _super and _superApply handle keeping the right this-context
            this._superApply( arguments );
            this._refresh();
        },

        // _setOption is called for each individual option that is changing
        _setOption: function( key, value ) {
            // prevent invalid color values
            this._super( key, value );
            this._refresh();
        },
        open: function(){
            var that = this
            that.options.beforeOpen()
            // work around a bug (likely same cause as #5265)
            $( that ).blur();

            // pass empty string as value to search for, displaying all results
            that.input .autocomplete( "search", "" );
            that.input .focus();
            that.options.open()
        },
        createInput: function(){
            var that = this
            this.input.autocomplete({
                delay: 50,
//                search: function(e, f){
//                  that.select.children('option').each(function(){
//                      var text = this.text.toLowerCase().replace(/á|é|í|ó|ú|ñ|ä|ë|ï|ö|ü/ig,function (str,offset,s) {
//                            var str =str=="á"?"a":str=="é"?"e":str=="í"?"i":str=="ó"?"o":str=="ú"?"u":str=="ñ"?"n":str;
//                                str =str=="Á"?"A":str=="É"?"E":str=="Í"?"I":str=="Ó"?"O":str=="Ú"?"U":str=="Ñ"?"N":str;
//                                str =str=="Á"?"A":str=="É"?"E":str=="Í"?"I":str=="Ó"?"O":str=="Ú"?"U":str=="Ñ"?"N":str;
//                                str =str=="ä"?"a":str=="ë"?"e":str=="ï"?"i":str=="ö"?"o":str=="ü"?"u":str;
//                                str =str=="Ä"?"A":str=="Ë"?"E":str=="Ï"?"I":str=="Ö"?"O":str=="Ü"?"U":str;
//                            return (str);
//                        })
////                        var mat = new RegExp( $.ui.autocomplete.escapeRegex(val), "i" );
////                      if(text == this.value.toLowerCase())
//                          return $(this).text()
//                  })
//                  return false;
//                },
                minLength: that.options.minLength,
                source: function( request, response ) {
                    var term = that.extractLast(request.term)
                    response( 
                        $.ui.autocomplete.filter(
                            that.select.children( "option" ), that.extractLast( request.term ) 
                        )
//                    var val1 = request.term,
//                        consult = val1.split(' ')
//                    that.select.children('option').map(function(){
//                        var text = $( this ).text(), find = false,find1 = false;
//                        
//                        for(var i=0;i<consult.length; i++){
//                            var mat = new RegExp( $.ui.autocomplete.escapeRegex(consult[i]), "i" );
//                            if(mat.test(text) && find1){
//                                find = true;
//                            }
//                            else if(mat.test(text)){
//                                find1 = true;
//                            }
//                            
//                        }
//                        if(find){
//                            console.log(text)
//                            return {
//                                label: text.replace(
//                                    new RegExp(
//                                        "(?![^&;]+;)(?!<[^<>]*)(" +
//                                        $.ui.autocomplete.escapeRegex(consult[0]) +
//                                        ")(?![^<>]*>)(?![^&;]+;)", "gi"
//                                    ), "<strong>$1</strong>" ).replace(
//                                    new RegExp(
//                                        "(?![^&;]+;)(?!<[^<>]*)(" +
//                                        $.ui.autocomplete.escapeRegex(consult[1]) +
//                                        ")(?![^<>]*>)(?![^&;]+;)", "gi"
//                                    ), "<strong>$1</strong>" ),
//                                value: $( this ).text(),
//                                option: this
//                            };
//                        }
//                    })
                    );
                },
                focus: function() {
                    this.select()
                    that.options.onFocus();
                    // prevent value inserted on focus
                    return false;
                },
                select: function( event, ui ) {
                    var terms = that.split(this.value), 
                        terms1 = that.split(ui.item.text);
                        
                    terms.pop()
                    terms = terms.concat(terms1)
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push( ui.item.text );
                    // add placeholder to get the comma-and-space at the end
//                    terms.push( "" );
//                    vals = that.split(this.value)
                    that.select.children( "option" )
                        .attr('selected', false)
                        .each(function(i){
                            for(var j = 0; j < terms.length; j++){
                                if(terms[j] == this.value || terms[j] == this.text){
                                    if(this.text != 'Agregar'){
                                        $(this).attr('selected',true)
                                        if(!that.options.multiple)
                                            return false;
                                    }
                                }
                            }
                        })
                        var s = terms.unique().join( that.join )
                    this.value = s;
                    that.options.val = s
                    that.options.onSelect(ui.item, event )
                    return false; 
                },
                change: function( event, ui ) {
                    var terms = that.split(this.value)
                    that.select.children( "option" )
                        .attr('selected', false)
                        .each(function(i){
                            for(var j = 0; j < terms.length; j++){
                                if(terms[j] == this.value || terms[j] == this.text){
                                    if(this.text != 'Agregar'){
                                        $(this).attr('selected',true)
                                        if(!that.options.multiple)
                                            return false;
                                    }
                                }
                            }
                        })
                    if ( !ui.item )
                        that.removeIfInvalid( this );
                    that.options.onChange();
                },
                open: function() {
                    that.options.beforeOpen()
                    $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
                },
                close: function() {
                    $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
                }
            })
        },
        //
        split : function ( val ) {
//            console.log(val)
            return val.split( /,\s*/ );
        },
        extractLast: function ( term ) {
            return this.split( term ).pop();
        },
        intersectArrays: function (a, b){
        var ai=0, bi=0;
        var result = new Array();

        while( ai < a.length && bi < b.length )
        {
            if      (a[ai] < b[bi] ){ ai++; }
            else if (a[ai] > b[bi] ){ bi++; }
            else
            {
            result.push(a[ai]);
            ai++;
            bi++;
            }
        }

        return result;
        },
        removeIfInvalid : function (element) {
            var that = this,
                value = $( element ).val(),
                vals = that.split(value),
                valid = new Array(),
                exist = new Array();
                
            that.select.children( "option" ).each(function(i){
                exist[$( this ).val()] = new Array()
                exist[$( this ).val()]['exist'] = false
                exist[$( this ).val()]['text'] = $( this ).text()
                if($.inArray($( this ).text(),vals) >= 0){
                    valid.push($( this ).text())
                    exist[$( this ).val()]['exist'] = true
                    if(!that.options.multiple)
                        return true;
                }
            })
            var val = that.split(value),
                last = val.pop();
            val = valid.unique().join(that.join);
            if($.inArray(last,valid) < 0){
                $( element )
                    .val(that.options.multiple && val != ''?val+that.join:'' )
                    .attr( "title", "'"+( that.options.multiple?last:last+'-' ) + "' no válido" )
//                    .tooltip( "open" );
                that.select.val( "" );
//                setTimeout(function() {
//                    that.input.tooltip( "close" ).attr( "title", "" );
//                }, 2500 );
            }

            that.input.data( "autocomplete" ).term = that.options.multiple?valid:'';
            return false;
        },
        _create: function() {
            var that = this;
                that.input
                that.join = that.options.join
                that.select = that.element.hide(),
                that.options.multiple = that.select.attr('multiple')?true:false;
                that.selected = that.select.find( ":selected" ),
                that.wrapper = that.wrapper = $( "<span>" )
                    .addClass( "ui-combobox" )
                    .insertAfter( that.select );
            var str = ''
            if(!that.options.multiple)
                that.join = ''
            that.selected.each(function () {
                str += $(this).text() + that.join;
            });
            that.value = str,
            that.input  = $( "<input>" )
                .appendTo( that.wrapper )
                .val(that.value)
                .attr( "title", "" )
                .addClass( "ui-state-default ui-combobox-input grid_14 alpha" )
                .bind( "keydown", function( event ) {
                    if ( event.keyCode === $.ui.keyCode.TAB && that.input.autocomplete( "widget" ).is( ":visible" )) {
                        event.preventDefault();
                    }
                })
                .click(function(){
                    that.options.onClick()
                })
                .hover(function(){
                    $(this).addClass('ui-state-hover')
                }, function(){
                    $(this).removeClass('ui-state-hover')
                })
                .addClass( "ui-widget ui-widget-content ui-corner-left" );
            that.createInput()
            that.input .data( "autocomplete" )._renderItem = function( ul, item ) {
                return $( "<li>" )
                    .data( "item.autocomplete", item )
                    .append( "<a>" + item.label + "</a>" )
                    .appendTo( ul );
            };

            that.buton = $( "<a>" )
                .attr( "tabIndex", -1 )
                .attr( "title", "Muestra toda la lista" )
//                .tooltip()
                .appendTo( that.wrapper )
                .button({
                    icons: {
                        primary: "ui-icon-triangle-1-s"
                    },
                    text: false
                })
                .removeClass( "ui-corner-all" )
                .addClass( "ui-corner-right ui-combobox-toggle grid_6 omega" )
                .click(function() {
                    // close if already visible
                    if ( that.input .autocomplete( "widget" ).is( ":visible" ) ) {
                        that.input.autocomplete( "close" );
                        return;
                    }
                    that.removeIfInvalid( that.input  );
                    that.open()
                });

//                that.input 
//                    .tooltip({
//                        position: {
//                            of: that.button
//                        },
//                        tooltipClass: "ui-state-highlight"
//                    });
            that.options.onCreate()
        }
    });
})( jQuery );

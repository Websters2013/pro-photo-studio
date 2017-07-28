( function(){

    "use strict";

    $(function () {

        $.each( $( '.media-gallery' ), function(){

            new MediaGallery ( $( this ) )

        } );

    } );

    var MediaGallery = function( obj ) {

        var _obj = obj,
            _wrapper = _obj.find( '.media-gallery__wrap' ),
            _switcher = _obj.find( '.media-gallery__switcher' ),
            _switchBtn = _switcher.find( 'button' ),
            _cover = _obj.find( '.media-gallery__cover' ),
            _preloader = _obj.find( '.preloader' ),
            _btnMore = _obj.find( '.media-gallery__more' ),
            _btnAction = _btnMore.attr( 'href' ),
            _window = $( window ),
            _isGallery = false,
            _firstGroup = true,
            _filterFlag = false,
            _request = new XMLHttpRequest();

        var _onEvents = function () {

                _switchBtn.on( 'click', function () {

                    var curBtn = $( this ),
                        curType = curBtn.data( 'type' );

                    _switchBtn.removeClass( 'active' );
                    curBtn.addClass( 'active' );
                    _wrapper.isotope( { filter: '.'+ curType } );

                    _filterFlag = true;

                    return false;

                } );

                _btnMore.on( {
                    click: function() {
                        _loadNewItems();
                        return false;
                    }
                } );

            },
            _addGalleryContent = function ( msg ) {

                if ( _obj.attr( 'data-loaded-group' ) !== 0 && _isGallery ){
                    _destroyGallery();
                }

                var hasItems = msg.has_items,
                    getItems = msg.items,
                    newBlock;

                $.each( getItems, function( ){

                    var curItem = this;

                    newBlock = $( '<div class="media-gallery__item new '+ curItem.type +'">'+
                        '<img src="'+ curItem.dummy +'" alt="'+ curItem.type +'"/>'+
                        '</div>' );

                    _wrapper.append( newBlock );

                } );

                var newItems = _wrapper.find( '.new' );

                setTimeout( function(){
                    _heightAnimation( hasItems, newItems );
                }, 550 );

                setTimeout( function(){
                    _initGallery();
                }, 500 );

                _obj.attr( 'data-loaded-group', +_obj.attr( 'data-loaded-group' )+1 );

            },
            _destroyGallery = function() {

                _wrapper.isotope( 'destroy' );
                _isGallery = false;

            },
            _heightAnimation = function( hasItems, newItems ){

                var duration = 500;

                if ( _firstGroup ){
                    duration = 1
                }

                _cover.animate( {
                    height: _wrapper.outerHeight()
                }, {
                    duration: duration,
                    complete: function(){

                        _cover.css( 'height', '' );

                        newItems.each( function( i ){
                            _showNewItems( $( this ), i );
                        } );

                        if ( hasItems == 0 ){
                            _removeBtnMore();
                        }

                    }
                } );

                if ( _firstGroup ){
                    setTimeout( function() {
                        _firstGroup = false;
                    }, 500 );
                }

            },
            _showNewItems = function( item, index ){

                var delay = 100;

                if ( _firstGroup ) {
                    delay = 1
                }

                setTimeout( function() {
                    item.removeClass( 'new' );
                }, index * delay );

            },
            _initGallery = function () {

                var wrapItem = '.media-gallery__item';

                _isGallery = true;

                _wrapper.isotope( {
                    itemSelector: wrapItem,
                    percentPosition: true,
                    masonry: {
                        columnWidth: '.media-gallery__sizer'
                    }
                } );

                if ( _filterFlag ){
                    _wrapper.isotope( { filter: '.'+ _switchBtn.filter( '.active' ).data( 'type' ) } );
                }

                setTimeout( function () {
                    _preloader.removeClass( 'active' );
                }, 300 )

            },
            _removeBtnMore = function(){

                _btnMore.css( 'opacity', 0 );

                setTimeout( function(){

                    _btnMore.css( 'padding', 0 );

                    _btnMore.animate( {
                        height: 0
                    }, {
                        duration: 500,
                        complete: function(){
                            _btnMore.remove();
                        }
                    } );

                }, 300 );

            },
            _loadNewItems = function(){

                var path  = _btnAction;

                _preloader.addClass( 'active' );

                _request.abort();
                _request = $.ajax( {
                    url: path,
                    data: {
                        loadedGroup: _obj.attr( 'data-loaded-group' ),
                        loadedType: _switchBtn.data( 'type' )
                    },
                    dataType: 'json',
                    timeout: 20000,
                    type: "GET",
                    success: function ( msg ) {

                        _cover.height( _cover.height() );

                        _addGalleryContent( msg );

                    },
                    error: function ( XMLHttpRequest ) {
                        if( XMLHttpRequest.statusText != 'abort' ) {
                            alert( 'Error!' );
                        }
                    }
                } );

            },
            _init = function () {

                _loadNewItems();
                _onEvents();

            };

        _init();

    };

} )();

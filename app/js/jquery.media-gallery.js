( function(){

    "use strict";

    $(function () {

        $.each( $( '.media-gallery' ), function(){

            new MediaGallery ( $( this ) )

        } );

    } );

    var MediaGallery = function( obj ) {

        var _obj = obj,
            _body = $( 'body' ),
            _wrapper = _obj.find( '.media-gallery__wrap' ),
            _switcher = _obj.find( '.media-gallery__switcher' ),
            _switchBtn = _switcher.find( 'button' ),
            _cover = _obj.find( '.media-gallery__cover' ),
            _preloader = _obj.find( '.preloader' ),
            _btnMore = _obj.find( '.media-gallery__more' ),
            _fileLink = _body.data( 'action' ),
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

                _obj.on( 'click', '.media-gallery__item', function() {

                    SwiperPopup( $( this ), $( this ).index() );
                    return false;

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

                var path  = _fileLink;

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

    var SwiperPopup = function ( obj, index ) {

        var _self = this,
            _obj = obj,
            _body = $( 'body' ),
            _wrapper = _obj.parent(),
            _galleryWrap = _obj.parents( '.media-gallery' ),
            _html = $( 'html' ),
            _window = $( window ),
            _links = _wrapper.find( '.media-gallery__item img' ),
            _popup = null,
            _popupInner = null,
            _popupClose = null,
            _swiperWrapper = null,
            _swiperContainer = null,
            _swiperPagination = null,
            _swiperBtnNext = null,
            _swiperBtnPrev = null,
            _swiper = null;

        var _addEvents = function(){

                _window.on({

                    resize: function (){

                        _setPictureSizeWhenResize();

                    }

                });

                _popupInner.parent().on({

                    click: function(){

                        _closePopup();

                    }

                });

                _popupInner.on({

                    click: function( event ){

                        event.stopPropagation();

                    }

                });

                _popupClose.on({
                    click: function(){

                        _closePopup();
                        return false;

                    }
                })

            },
            _addingVariables = function(){

                var type = _galleryWrap.attr( 'data-loaded-type' );

                _popup = $( '<div class="swiper-popup">\
                                    <div class="swiper-container">\
                                        <div class="swiper-wrapper"></div>\
                                        <div class="swiper-pagination"></div>\
                                        <div class="swiper-button-next"></div>\
                                        <div class="swiper-button-prev"></div>\
                                    </div>\
                                </div>' );
                _swiperWrapper = _popup.find( '.swiper-wrapper' );
                _swiperContainer = _popup.find( '.swiper-container' );
                _swiperPagination = _popup.find( '.swiper-pagination' );
                _swiperBtnNext = _popup.find( '.swiper-button-next' );
                _swiperBtnPrev = _popup.find( '.swiper-button-prev' );

            },
            _addVideo = function () {

                var activeSlide = _popup.find( '.swiper-slide-active' ),
                    src = activeSlide.find( '[data-src]' ).data( 'src' ),
                    innerContent = $( '<iframe src="' + src + '"> frameborder="0" allowfullscreen></iframe>' );

                $( '.swiper-slide-active' ).find( '.swiper-popup__video' ).prepend( innerContent );

            },
            _buildPopup = function(){

                _addingVariables();
                _contentFilling();
                _initSwiper();
                _swiper.slideTo( index, 0 );
                _popup.addClass( 'active' );
                _setStyles();
                _swiper.onResize();

            },
            _closePopup = function(){

                _popup.removeClass( 'active' );
                setTimeout( function(){
                    _html.css({overflow: '', paddingRight: ''});
                    _popup.remove();
                }, 300 );

            },
            _contentFilling = function(){

                $.each( _links, function(){

                    var innerContent = null,
                        dataSRC = null,
                        preloader = null;

                    if ( $( this ).hasClass( 'media-gallery__item_video' ) ){

                        preloader = '<i class="fa fa-spinner fa-spin"></i>';
                        innerContent = '<div class="swiper-popup__video"/>';
                        dataSRC = 'data-src="' + $(this).attr( "href" ) + '"';

                    } else {

                        preloader = '';
                        innerContent = '<img src="' + $( this ).attr( 'src' ) + '">';
                        dataSRC = '';

                    }

                    var newItem = $( '<div class="swiper-slide">\
                                        <div class="swiper-popup__inner" ' + dataSRC + '>\
                                            <a href="#" class="swiper-popup__close"></a>\
                                            ' + preloader + '\
                                            ' + innerContent + '\
                                            <span class="swiper-slide__title">' + $( this ).attr( 'title' ) + '</span>\
                                        </div>\
                                    </div>' );

                    _swiperWrapper.append( newItem );

                    newItem.find( 'img' ).on( {
                        load: function(){
                            $( this ).attr( 'data-width', this.width );
                            $( this ).attr( 'data-height', this.height );
                            _setPictureSize( this.width, this.height, $( this ) );
                        }
                    } );

                } );

                _body.append( _popup );

                _popupInner = _popup.find( '.swiper-popup__inner' );
                _popupClose = _popup.find( '.swiper-popup__close' );

            },
            _getScrollWidth = function (){
                var scrollDiv = document.createElement( 'div' ),
                    scrollbarWidth = null;
                document.body.appendChild( scrollDiv );
                scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth;
                document.body.removeChild( scrollDiv );
                return scrollbarWidth;
            },
            _initSwiper = function(){

                _swiper = new Swiper( _swiperContainer, {
                    pagination: _swiperPagination,
                    nextButton: _swiperBtnNext,
                    prevButton: _swiperBtnPrev,
                    slidesPerView: 1,
                    paginationClickable: true,
                    onSlideChangeEnd: function(){
                        _removeVideo();
                        if ( $( '.swiper-slide-active' ).find( '[data-src]' ).length ){
                            _addVideo();
                        }
                    }
                });

            },
            _init = function () {
                _buildPopup();
                _addEvents();
                _obj[ 0 ].obj = _self;
            },
            _removeVideo = function(){

                var items = _popup.find( '.swiper-slide' ),
                    videoFrame = items.find( '.swiper-popup__video iframe' );
                videoFrame.remove();

            },
            _setPictureSize = function( picWidth, picHeight, pic ){

                var k = 0;

                if ( ( _popup.width()/picWidth ) > ( _popup.height()/picHeight ) ) {
                    k = _popup.height()/picHeight ;
                } else {
                    k = _popup.width()/picWidth;
                }

                if ( k >= 1 ){

                    pic.css({
                        "width": picWidth*0.85,
                        "height": picHeight*0.85
                    });

                } else {

                    pic.css({
                        "width": k*picWidth*0.85,
                        "height": k*picHeight*0.85
                    });

                }

            },
            _setPictureSizeWhenResize = function(){

                $.each( _swiperWrapper.find( 'img' ), function () {

                    _setPictureSize( $( this ).data( 'width' ), $( this ).data( 'height' ), $( this ) );

                } );

            },
            _setStyles = function(){

                _html.css({
                    overflow: 'hidden',
                    paddingRight: _getScrollWidth()
                });

            };

        _init();

    };

} )();

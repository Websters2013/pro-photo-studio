( function(){

    $( function(){

        $.each( $( '.anchor' ), function() {
            new Anchor ( $( this ) );
        } );

        $.each( $( '.partners' ), function() {
            new Sliders ( $( this ) );
        } );

        $.each( $( '.catalog' ), function() {
            new Sliders ( $( this ) );
        } );

        $.each( $( '.promo__slider' ), function() {
            new Sliders ( $( this ) );
        } );

        $.each( $( '.sub-menu' ), function() {
            new Sliders ( $( this ) );
        } );

        $.each( $( '.mobile-menu' ), function() {
            new Menu ( $( this ) );
        } );

        $.each( $( '.blog__sort' ), function () {
            new Sort( $( this ) );
        } );

        $.each( $( '.head-shot' ), function () {
            new HeadShotLoader( $( this ) );
        } );

        $.each( $( '.rates__item-swiper' ), function () {
            new Sliders( $( this ) );
        } );

    } );

    var Anchor = function ( obj ) {
        var _obj = obj,
            _window = $( 'html, body' );

        var _onEvents = function() {

                _obj.on( {
                    click: function() {

                        if ( $('.menu').hasClass( 'mobile' ) ) {
                            $( ".menu-btn" ).trigger( 'click' );
                        }

                        _window.animate( {
                            scrollTop: $( $.attr(this, 'href') ).offset().top
                        }, 600);
                        $( '.menu' )[0].obj.destroy();

                        return false;
                    }
                } );

            },
            _construct = function() {
                _onEvents();
            };

        _construct()
    };

    var Menu = function( obj ){

        //private properties
        var _obj = obj,
            _btn = $( '.mobile-menu-btn' );

        //private methods
        var _constructor = function(){
                _onEvents();
            },
            _onEvents = function(){

                _btn.on( 'click', function() {

                    if ( $( this).hasClass( 'close' ) ){
                        _closeMenu();
                    } else {
                        _openMenu();
                    }

                } );

            },
            _openMenu = function(){
                _btn.addClass( 'close' );
                _obj.addClass( 'visible' );
            },
            _closeMenu = function(){
                _btn.removeClass( 'close' );
                _obj.removeClass( 'visible' );
            };

        //public properties

        //public methods

        _constructor();

    };

    var Sliders = function( obj ) {

        //private properties
        var _obj = obj,
            _partnersSlider = _obj.find( '.partners__swiper' ),
            _subMenuSlider = _obj.find( '.sub-menu__swiper' ),
            _catalogSlider = _obj.find( '.catalog__swiper' ),
            _promoSlider = _obj.find( '.promo__swiper' ),
            _ratesSlider = _obj.find( '.rates__swiper' ),
            _partnersPrev = _obj.find( '.partners__swiper-prev' ),
            _catalogPrev = _obj.find( '.catalog__swiper-prev' ),
            _promoPrev = _obj.find( '.promo__swiper-prev' ),
            _ratesPrev = _obj.find( '.rates__swiper-prev' ),
            _partnersNext = _obj.find( '.partners__swiper-next' ),
            _catalogNext = _obj.find( '.catalog__swiper-next' ),
            _promoNext = _obj.find( '.promo__swiper-next' ),
            _ratesNext = _obj.find( '.rates__swiper-next' ),
            _partners,
            _catalog,
            _subMenu,
            _promo,
            _rates,
            _window = $( window );

        //private methods
        var _initSlider = function() {

                _partners = new Swiper ( _partnersSlider, {
                    autoplay: 10000,
                    speed: 500,
                    effect: 'slide',
                    slidesPerView: 'auto',
                    loop: true,
                    loopedSlides: 20,
                    spaceBetween: 80,
                    nextButton: _partnersNext,
                    prevButton: _partnersPrev
                } );

                _catalog = new Swiper ( _catalogSlider, {
                    autoplay: 10000,
                    speed: 500,
                    effect: 'slide',
                    slidesPerView: 3,
                    loop: true,
                    nextButton: _catalogNext,
                    prevButton: _catalogPrev,
                    breakpoints: {
                        767: {
                            slidesPerView: 1
                        },
                        1199: {
                            slidesPerView: 2
                        }
                    }
                } );

                _promo = new Swiper ( _promoSlider, {
                    autoplay: 10000,
                    speed: 500,
                    effect: 'slide',
                    slidesPerView: 1,
                    loop: true,
                    nextButton: _promoNext,
                    prevButton: _promoPrev
                } );

                _rates = new Swiper ( _ratesSlider, {
                    autoplay: false,
                    speed: 500,
                    effect: 'slide',
                    slidesPerView: 'auto',
                    loop: false,
                    nextButton: _ratesNext,
                    prevButton: _ratesPrev
                } );

                _subMenu = new Swiper ( _subMenuSlider, {
                    autoplay: false,
                    speed: 500,
                    effect: 'slide',
                    slidesPerView: 'auto',
                    simulateTouch: false,
                    onSlideChangeStart: function() {
                        _obj.removeClass( 'start' );
                        _subMenuSlider[0].swiper.slideTo( _subMenu.find( '.active' ).index() , 200, false );
                    },
                    onSlideChangeEnd: function() {
                        _obj.removeClass( 'end' );
                    },
                    onReachBeginning: function() {
                        _obj.addClass( 'start' );
                        _obj.removeClass( 'end' );

                        setTimeout( function() {
                            _obj.addClass( 'start' );
                        },300 )

                    },
                    onReachEnd: function() {
                        _obj.addClass( 'end' );

                        setTimeout( function() {
                            _obj.removeClass( 'start' );
                        },300 )
                    }
                } );

            },
            _onEvent = function() {

                if ( _window.outerWidth() <= 767  ){
                    _initSlider ();
                }

                _window.on( {
                    'resize': function() {

                        if ( _window.outerWidth() >= 767  ){
                            _destroySlider();
                        } else {
                            _initSlider();
                        }

                    }
                } )

            },
            _destroySlider = function() {

                _subMenuSlider[ 0 ].swiper.destroy( false, true );

            },
            _init = function() {
                _onEvent();
                _initSlider();
            };

        //public properties

        //public methods

        _init();
    };

    var Sort = function (obj) {

        //private properties
        var _obj = obj,
            _site = $( '.site' ),
            _window = $( window );

        //private methods
        var _construct = function () {

                _onEvent();

            },
            _onEvent = function() {

                _site.on(
                    'click', function ( e ) {

                        if ( _obj.hasClass( 'open' ) && $( e.target ).closest( _obj ).length == 0 ){
                            _closeLanguage();
                        }

                    }
                );

                _obj.on( 'click', function () {

                    var curElem = $( this );

                    if( curElem.hasClass( 'open' ) && _window.width() < 1200 ){
                        _closeLanguage();
                    } else if ( _window.width() < 1200 ) {
                        _openLanguage();
                    }

                } )

            },
            _closeLanguage = function() {
                _obj.removeClass( 'open' );
            },
            _openLanguage = function() {
                _obj.addClass( 'open' )
            };

        //public properties

        //public methods

        _construct();
    };

    var HeadShotLoader = function (obj) {

        //private properties
        var _obj = obj,
            _body = $( 'body' ),
            _fileLink = _body.data( 'action' ),
            _btnMore = _obj.find( '.head-shot__command-more' ),
            _preloader = _obj.find( '.preloader' ),
            _wrapper = _obj.find( '.head-shot__command-wrap' ),
            _cover = _obj.find( '.head-shot__command-cover' ),
            _firstGroup = true,
            _request = new XMLHttpRequest();

        //private methods
        var _construct = function () {
                _loadNewItems();
                _onEvent();
            },
            _addGalleryContent = function ( msg ) {

                var hasItems = msg.has_items,
                    getItems = msg.items,
                    newBlock;

                console.log( hasItems )

                $.each( getItems, function( ){

                    var curItem = this;

                    newBlock = $( '<div class="head-shot__command-item new">'+
                        '<img src="'+ curItem.dummy +'" alt="'+ curItem.title +'"/>'+
                        '</div>' );

                    _wrapper.append( newBlock );

                } );

                var newItems = _wrapper.find( '.new' );

                setTimeout( function(){
                    _heightAnimation( hasItems, newItems );
                }, 550 );

                _obj.attr( 'data-loaded-group', +_obj.attr( 'data-loaded-group' ) + 1 );

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
                            console.log( $( this ) )
                            console.log( i )
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
            _loadNewItems = function(){

                var path  = _fileLink;

                _preloader.addClass( 'active' );

                _request.abort();
                _request = $.ajax( {
                    url: path,
                    data: {
                        action: 'gallery',
                        type: 'headshot',
                        page: _obj.attr( 'data-loaded-group' )
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
            _onEvent = function() {

                _btnMore.on( 'click', function () {

                    _loadNewItems();

                    return false;

                } );

            };

        //public properties

        //public methods

        _construct();
    };

} )();
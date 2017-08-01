( function(){

    $( function(){

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

    } );

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
            _partnersPrev = _obj.find( '.partners__swiper-prev' ),
            _catalogPrev = _obj.find( '.catalog__swiper-prev' ),
            _promoPrev = _obj.find( '.promo__swiper-prev' ),
            _partnersNext = _obj.find( '.partners__swiper-next' ),
            _catalogNext = _obj.find( '.catalog__swiper-next' ),
            _promoNext = _obj.find( '.promo__swiper-next' ),
            _partners,
            _catalog,
            _subMenu,
            _promo,
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

                _subMenu = new Swiper ( _subMenuSlider, {
                    autoplay: false,
                    speed: 500,
                    effect: 'slide',
                    slidesPerView: 'auto',
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

} )();
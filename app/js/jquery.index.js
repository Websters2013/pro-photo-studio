( function(){

    $( function(){

        $.each( $( '.partners' ), function() {
            new Sliders ( $( this ) );
        } );

        $.each( $( '.mobile-menu' ), function() {
            new Menu ( $( this ) );
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
            _partnersPrev = _obj.find( '.partners__swiper-prev' ),
            _partnersNext = _obj.find( '.partners__swiper-next' ),
            _partners;

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

            },
            _init = function() {
                _initSlider();
            };

        //public properties

        //public methods

        _init();
    };

} )();
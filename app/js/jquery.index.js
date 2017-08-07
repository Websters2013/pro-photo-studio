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

        $.each( $( '.hiring__item' ), function () {
            new Hiring( $( this ) );
        } );

        $.each( $( '.rates__item-swiper' ), function () {
            new Sliders( $( this ) );
        } );

        $.each( $( '.place-order__form' ), function () {
            new PlaceOrderForm( $( this ) );
        } );

        $.each( $('.place-order__sign'), function () {

            new ContactSign( $(this) );

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

    var Hiring = function ( obj ) {
        var _obj = obj,
            _btn = _obj.find( '.hiring__btn' ),
            _forum = _obj.find( '.hiring__form' ),
            _hideContent = _obj.find( '.hiring__item-hide' ),
            _window = $( 'html, body' );

        var _onEvents = function() {

                _btn.on( {
                    click: function() {

                        _hideContent.addClass( 'hide' );
                        _forum.addClass( 'visible' );

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

    var PlaceOrderForm = function( obj ){

        //private properties
        var _obj = obj,
            _stepsWrap = $( '.place-order__steps' ),
            _stepsItem = _stepsWrap.find( '.place-order__steps-item' ),
            _stepsLine = _stepsWrap.find( 'div > span' ),
            _formWrap = _obj.find( '.place-order__form-wrap' ),
            _formItemBlock = _obj.find( '.place-order__form-item' ),
            _fields = _formItemBlock.find( 'input' ),
            _checkbox = _formItemBlock.find( 'input[type=checkbox]' ),
            _select = _formItemBlock.find( 'select' ),
            _file = _formItemBlock.find( 'input[type=file]' ),
            _inputs = _formItemBlock.find( '[data-required]' ),
            _btn = _formItemBlock.find( '.place-order__form-next' ),
            _changeNumber = _formItemBlock.find( '.place-order__form-num' ),
            _changeNumberPlus = _changeNumber.find( '.plus' ),
            _changeNumberMinus = _changeNumber.find( '.minus' );

        //private methods
        var _constructor = function(){
                _setHeight();
                _onEvents();
            },
            _setHeight = function () {

                _formWrap.css( 'height', _formItemBlock.filter( '.active' ).outerHeight() )

            },
            _nextStep = function ( curForm ) {

                var curFormItemBlock = curForm,
                    nextFormItemBlock = curFormItemBlock.next( '.place-order__form-item' );

                curFormItemBlock.removeClass( 'active' );
                nextFormItemBlock.addClass( 'active' );

                for ( var i = 0; i <= nextFormItemBlock.index(); i++ ){
                    _stepsItem.eq(i).addClass( 'active' );
                }

                _stepsLine.css( 'width', ( nextFormItemBlock.index() + 1 ) * 100 / 4 +'%' );

                _setHeight();

            },
            _addNotTouchedClass = function ( form ) {

                var curFormItemBlock = form,
                    fields = curFormItemBlock.find( '[data-required]' );

                fields.each( function() {

                    var curItem = $(this);

                    if( curItem.val() === '' || curItem.val() === '0' || !curItem.is( ':checked' ) ){

                        curItem.addClass( 'not-touched' );
                        curItem.parents( '.websters-select' ).addClass( 'not-touched' );

                        _validateField( curFormItemBlock, curItem );

                    }

                } );

            },
            _makeNotValid = function ( field ) {
                field.addClass( 'not-valid' );
                field.parents( '.websters-select' ).addClass( 'not-valid' );
                field.removeClass( 'valid' );
            },
            _makeValid = function ( field ) {
                field.removeClass( 'not-valid' );
                field.parents( '.websters-select' ).removeClass( 'not-valid' );
                field.addClass( 'valid' );
            },
            _validateEmail = function ( email ) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            },
            _validateField = function ( form, field ) {

                var curFormItemBlock = $( this ),
                    type = field.attr( 'type'),
                    tagName = field[0].tagName;

                if( type === 'email' || type === 'text' || type === 'number' ){

                    if( field.val() === '' ){
                        _makeNotValid( field );
                        return false;
                    }

                }

                if( type === 'email' ){
                    if( !_validateEmail( field.val() ) ){
                        _makeNotValid( field );
                        return false;
                    }
                }

                if( type === 'number' ){
                    if( field.val() <= 0 ) {
                        _makeNotValid( field );
                        return false;
                    }
                }

                if( tagName.toLocaleLowerCase() == 'select' ){

                    if( field.val() === 0 ){
                        _makeNotValid( field );
                        return false;
                    }

                }

                _makeValid( field );

                if( _fields.filter( '.not-valid' ).length === 0 ) {

                    _nextStep( curFormItemBlock );

                }

            },
            _onEvents = function(){

                _fields.on( {
                    focus: function() {

                        $( this ).removeClass( 'not-touched' );

                    },
                    focusout: function() {

                        var curItem = $(this),
                            curForm = curItem.parents( '.place-order__form-item' );

                        _validateField( curForm, curItem );

                    },
                    keyup: function () {

                        var curItem = $(this),
                            curForm = curItem.parents( '.place-order__form-item' );

                        _validateField( curForm, curItem );
                    }
                } );

                _inputs.on( {
                    focusout: function() {

                        var letterCounter = 0;

                        _inputs.each( function () {

                            var curItem = $(this);

                            if ( curItem.val().length > 0 ){
                                letterCounter = letterCounter + 1
                            }

                        } );

                        if ( letterCounter === 0 ) {
                            _inputs.removeClass( 'not-valid' );
                        }

                    }
                } );

                _select.on( 'change', function () {

                    var curSelect = $( this ),
                        curParent = curSelect.parents( '.websters-select' );

                    curSelect.removeClass( 'not-valid not-touched' );
                    curParent.removeClass( 'not-valid not-touched' );

                } );

                _checkbox.on( 'change', function () {

                    var curSelect = $( this ),
                        curParent = curSelect.parents( '.websters-select' );

                    curSelect.removeClass( 'not-valid not-touched' );
                    curParent.removeClass( 'not-valid not-touched' );

                } );

                _btn.on( 'click', function() {

                    var curBtn = $( this ),
                        curFormItemBlock = curBtn.parents( '.place-order__form-item' );

                    if ( curFormItemBlock.find( '[data-required]' ).val() == 0 || curFormItemBlock.find( '[data-required]' ).val() == '' ){

                        _addNotTouchedClass( curFormItemBlock );

                    }

                    if( _fields.hasClass('not-touched') || _fields.hasClass('not-valid') || _select.hasClass('not-valid') ) {

                        _obj.find('.not-touched:first').focus();
                        _obj.find('.not-valid:first').focus();

                    } else {

                        _nextStep( curFormItemBlock );

                    }

                    return false;

                } );

                _changeNumberPlus.on( 'click', function() {

                    var curBtn = $( this ),
                        curParent = curBtn.parents( '.place-order__form-fieldset' ),
                        curInput = curParent.find( 'input[type=number]' ),
                        curNum = + curInput.val();

                    curInput.val( curNum + 1 );
                    curInput.removeClass( 'not-valid' );

                    return false;

                } );

                _changeNumberMinus.on( 'click', function() {

                    var curBtn = $( this ),
                        curParent = curBtn.parents( '.place-order__form-fieldset' ),
                        curInput = curParent.find( 'input[type=number]' ),
                        curNum = + curInput.val();

                    if ( curNum > 0 ){
                        curInput.val( curNum - 1 );
                        curInput.removeClass( 'not-valid' );
                    }

                    return false;

                } );

                _file.on( 'change', function () {

                    var curElem = $( this ),
                        curText = curElem.next( 'span' );

                    curText.text( curElem.val() )

                } )

            };

        //public properties

        //public methods

        _constructor();

    };

    var ContactSign = function (obj) {

        //private properties
        var _self = this,
            _obj = obj,
            _area = _obj.find('.place-order__sign-area'),
            _note = _obj.find('span'),
            _send = $( '.canvas_check' ),
            _window = $( window ),
            _result;

        //private methods
        var _destroySignature =  function() {

                _area.signature('destroy');

            },
            _onEvents = function() {

                _window.on( {
                    resize: function() {

                        _destroySignature();
                        _initSignature();

                    }
                } );

                _send.on( {

                    click: function() {

                        if( !_area.signature('isEmpty') ){

                            _result = _area.signature('toSVG');
                            _area.removeClass( 'contact__sign-area-red' );
                            $( '.sign_val' ).val( _result );

                        } else {

                            _area.addClass( 'contact__sign-area-red' );
                            $( '.sign_val' ).val('');

                        }


                    }

                } );

                _area.on( {

                    click: function() {

                        _note.remove();

                    }

                } );

            },
            _init = function() {

                _obj[0].obj = _self;
                _onEvents();
                _initSignature();

            },
            _initSignature = function() {
                _area.signature( {
                    thickness: 1,
                    color: '#b7b7b7'
                } );
            };

        _init();
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
                        page: _obj.attr( 'data-loaded-group' ),
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
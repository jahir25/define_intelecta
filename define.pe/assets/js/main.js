(function() {
  'use strict';
 
  $(window).scroll(function(){
    var scroll = parseInt($(this).scrollTop());
    var header =  $('.header__logo img');
    if (scroll > 5) {

      header.attr('src','assets/img/logo-define-1.png');
      $('.header__nav-list a').css('color','#808080');

    }else{
        header.attr('src','assets/img/logo-define-2.png');
        $('.header__nav-list a').css('color','white');
    }

  });

  $(document).ready(function() {
    var header = new Headhesive('.header', {offset: 0});
   
  })


  function updateNavProgress(event) {
    var target = $(event.currentTarget).siblings('.carousel-nav__wrapper'),
        maxLength = event.item.count

    $(event.currentTarget).data('max', maxLength);
    $(target).find('.carousel-nav__total').text((maxLength < 10 ? '0': '') + maxLength);

     var current = event.relatedTarget.current() - 1;
        var main = $('div#owl-1');
    //main.find('.carousel-nav__current').html('0'+current);
  }
 initCarousels();
  function initCarousels() {

    var owl_1 = $('.main-carousel').owlCarousel({
                    loop:true,
                    nav:false,
                    dots: true,
                    items: 1,
                    mouseDrag: false,
                    autoplay: true,
                    onChange: updateNavProgress
              });
    owl_1.on('changed.owl.carousel', function(event) {
        var current = event.relatedTarget.current() - 1;
        var main = $('div#owl-1');
        main.find('.carousel-nav__current').html('0'+current);

    })


   var owl_2 =  $('.nosotros-carousel').owlCarousel({
            loop:true,
            nav:false,
            dots: true,
            items: 1,
            mouseDrag: false,
            autoplay: true,
            onChange: updateNavProgress
    });

    owl_2.on('changed.owl.carousel', function(event) {
        var index = parseInt(event.page.index) + 1;
        var main = $('div#owl-2');
        main.find('.carousel-nav__current').html('0'+index);

    })




  }



  $(document).on('click', '.header__nav-list a, .share-icon, .carousel-contacto a, .project__link', function(ev) {
    ev.preventDefault();
    var target = $(ev.currentTarget).attr('href');

    var  height = parseInt($('.header').height());
    $('html, body').animate({
      scrollTop: $(target).offset().top  - (height + height / 2 )
    }, 1000)

  })

  $(document).on('click', '.carousel-nav__prev', function(ev) {
    var navWrapper = $(ev.target).closest('.carousel-nav__wrapper'),
        carousel = $(navWrapper).siblings('.owl-carousel'),
        current = carousel.data('current'),
        max = carousel.data('max');

    var prevId = --current < 1 ? max : current;

    carousel.data('current', prevId);
    $(navWrapper).find('.carousel-nav__current').text((prevId < 10 ? '0': '') + prevId);
    $(carousel).trigger('prev.owl.carousel');
  })

  $(document).on('click', '.carousel-nav__next', function(ev) {
    var navWrapper = $(ev.target).closest('.carousel-nav__wrapper'),
        carousel = $(navWrapper).siblings('.owl-carousel'),
        current = carousel.data('current'),
        max = carousel.data('max');

    var nextId = ++current > max ? 1 : current;

    carousel.data('current', nextId);
    $(navWrapper).find('.carousel-nav__current').text((nextId < 10 ? '0': '') + nextId);
    $(carousel).trigger('next.owl.carousel');
  })

// Contact form
  $(function() {

  	// Get the form.
  	var form = $('#ajax-contact');

  	// Get the messages div.
  	var formMessages = $('#form-messages');

  	// Set up an event listener for the contact form.
  	$(form).submit(function(e) {
  		// Stop the browser from submitting the form.
  		e.preventDefault();

  		// Serialize the form data.
  		var formData = $(form).serialize();

  		// Submit the form using AJAX.
  		$.ajax({
  			type: 'POST',
  			url: $(form).attr('action'),
  			data: formData,
        dataType: 'json'
  		})
  		.done(function(response) {

            if(Boolean(response.status)) {
                window.location = './gracias.html';   
              }else{
                alert('Error al envia el correo');
              }
              
            
  		})
  		.fail(function(data) {
  			// Make sure that the formMessages div has the 'error' class.
  			$(formMessages).removeClass('success');
  			$(formMessages).addClass('error');

  			// Set the message text.
  			if (data.responseText !== '') {
         
  				$(formMessages).text(data.responseText);
  			} else {
  				$(formMessages).text('Error al enviar correo');
  			}
  		});

  	});

  });

// Popup / footer contact form
  $(function() {


    $('.ajax-news').submit(function(event) {
      
    
      event.preventDefault();

          // Serialize the form data.

          var _this = $(this);
          var form = _this.closest('form');

          var formData = form.serialize();

          // Submit the form using AJAX.
          $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data: formData,
            dataType: 'json'
          })
          .done(function(response) {

              if(Boolean(response.status)) {
                window.location = './gracias.html';   
              }else{
                alert('Error al envia el correo');
              }
              
            
               
          
  
            
          })
          .fail(function(response) {
             console.log("error",response)
          });

    });
   

  });

  $(document).ready(function(){
   setTimeout(function(){
     //$("#myModal").modal()
   },3000);



   //animate

   
        function isScrolledIntoView(elem)
        {
            var docViewTop = $(window).scrollTop();
            var docViewBottom = docViewTop + $(window).height();
            var elemTop = $(elem).offset().top;
            var elemBottom = elemTop + $(elem).height();
            return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom) && (elemBottom <= docViewBottom) && (elemTop >= docViewTop));
        }

        $(window).scroll(function() {    
            if(isScrolledIntoView($('#box-1')))
            {
               
                var box = $('#box-1');
                if (!box.hasClass('animated')){
                    setTimeout(function(){
                        $('#animate-1.animate-box').removeClass('inactive')
                    },100);
                }

                
            } 

            if(isScrolledIntoView($('#box-2')))
            {
                var box = $('#box-2');
                if (!box.hasClass('animated')){
                   
                    setTimeout(function(){
                        $('#animate-2.animate-box').removeClass('inactive')
                    },100);
                }
                    
            }  

            if(isScrolledIntoView($('#box-3')))
            {
                var box = $('#box-3');
                if (!box.hasClass('animated')){
                   
                    setTimeout(function(){
                        $('#animate-3.animate-box').removeClass('inactive')
                    },100);
                }
            }  
        });


        function AnimateRotate(d,div){
            $({deg: 0}).animate({deg: d}, {
                step: function(now, fx){
                    $("#"+div).addClass('_rotate');
                }
            });
        }

       



  });
}());
 
window.onload = function(e){ 
    var hash = window.location.hash;
    if (hash!= '') {
        $('a.go-scroll').click();
    }
    
}


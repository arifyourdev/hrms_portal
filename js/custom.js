 $('#speak-slider').owlCarousel({
                loop: true,
                margin: 10,
                autoplay:true,
                nav: true,
                navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
              responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 3
                }
            }
    })
    
    $('#news-slider').owlCarousel({
                loop: true,
                margin: 10,
                autoplay:true,
                nav: true,
                navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
              responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 2
                }
            }
    })
    
     $('#workshop-slider').owlCarousel({
                loop: true,
                margin: 10,
                autoplay:true,
                nav: true,
                navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
              responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 2
                }
            }
    })

//     $('#book-class-slider').owlCarousel({
//         loop: true,
//         margin: 10,
//         autoplay:true,
//         nav: true,
//         navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
//       responsive: {
//         0: {
//             items: 1
//         },
//         600: {
//             items: 1
//         },
//         1000: {
//             items: 1
//         }
//     }
// })
    
     $('#Newsroom-slider').owlCarousel({
                loop: true,
                margin: 90,
                autoplay:true,
                nav: true,
                navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
              responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1200: {
                    items: 4
                }
            }
    })
    
    $('#work-with-us-slider').owlCarousel({
                loop: true,
                margin: 10,
                autoplay:true,
                // nav: true,
                // navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
              responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 4
                }
            }
    })
    
//     function setDots(){
//     $("#blog-banner .owl-dots").removeClass('disabled');
//   }
    
    $('#blog-banner').owlCarousel({
                loop: true,
                margin: 0,
                dots: true,
                autoplay:true,
                // nav: true,
                navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
              responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
    })
     $('#educate-banner').owlCarousel({
                loop: true,
                margin: 0,
                dots: true,
                autoplay:true,
                // nav: true,
                navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
              responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
    })
    
    $('#event-banner').owlCarousel({
              items: 1,
              loop: true,
              nav: false,
              dots: true,
              margin: 10,
              autoplay: true,
              dotsText: ['<div class="owl-dot"><span></span></div>'],
              responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
    })
    
     $('#webinar-banner').owlCarousel({
              items: 1,
              loop: true,
              nav: false,
              dots: true,
              margin: 10,
              autoplay: true,
              dotsText: ['<div class="owl-dot"><span></span></div>'],
              responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
    })
    
    
  $(window).on('load',function(){
    var delayMs = 100; // delay in milliseconds
    
    setTimeout(function(){
        $('#myModal').modal('show');
    }, delayMs);
});
$(function(){
     $('#accButton').click(function(){
          $('#myModal').modal('hide');
      });
  });
  
  
 
 
    
    
    
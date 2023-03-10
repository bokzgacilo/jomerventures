showAnswer = (faqID) => {
  $.ajax({
    type: 'get',
    url: 'api/getFaqAnswer.php',
    data: {
      faqID: faqID
    },
    success: (response) => {
      console.log(response)
    }
  })
}

viewBooking = (tourID) => {
  var email = sessionStorage.getItem('email');

  $.ajax({
    type: 'get',
    url: 'api/getMyBookings.php',
    data: {
      email: email,
      reference_number: tourID
    },
    beforeSend: () => {
      $('.loading-spinner').css({'display':'flex'})
    },
    success: (response) => {
      $('#myBookings').html(response);
      $('.loading-spinner').css({'display':'none'})
    }
  })
}

pay = (reference_number) => {
  var amount = $('#payment_amount').val();
  var gcash = $('#payment_gcash').val();

  $.ajax({
    type: 'post',
    url: 'api/makepayment.php',
    data: {
      reference_number: reference_number,
      amount: amount,
      gcash: gcash,
      email: sessionStorage.getItem('email')
    },
    beforeSend: () => {
      $('.loading-spinner').css({'display':'flex'});
    },
    success: (response) => {
      console.log(response);
      if(response == 1){
        Swal.fire(
          'Paid Successfully',
          "It will take 3-5 days to process your transaction.",
          'success'
        )
      }
      $('.loading-spinner').css({'display':'none'});
    }
  })
}

changePickupLocation = (id) => {
  var newPickup = $('#newPickupLocation').val();

  $.ajax({
    type: 'post',
    url: 'api/changePickupLocation.php',
    data: {
      tourID: id,
      newPickup: newPickup
    },
    beforeSend: () => {
      $('.loading-spinner').css({'display':'flex'})
    },
    success: (response) => {
      if(response == 1){
        Swal.fire(
          'Tour Pickup Location Changed',
          "Your tour pickup location was successfully changed.",
          'success'
        )
      }
      $('.loading-spinner').css({'display':'none'})
    }
  })
}

changeTravelDate = (id) => {
  var newDate = $('#updatedTravelDate').val();
  $.ajax({
    type: 'post',
    url: 'api/changeTravelDate.php',
    data: {
      tourID: id,
      newDate: newDate
    },
    beforeSend: () => {
      $('.loading-spinner').css({'display':'flex'})
    },
    success: (response) => {
      if(response == 1){
        Swal.fire(
          'Tour Travel Date Changed',
          "Your tour travel date is successfully changed.",
          'success'
        )
      }
      $('.loading-spinner').css({'display':'none'})
    }
  })
}

settlePayment = (reference_number) => {
  mode = 'GCASH';
  switch (mode) {
    case 'GCASH':
      $('#settlePaymentGCash').css({'display':'flex'});
      $.ajax({
        type: 'get',
        url: 'api/getsettlePaymentDetails.php',
        data: {
          reference_number: reference_number
        },
        success: (response) => {
          $('#settlePayment').html(response);
        }
      })
      break;
    case 'PAYPAL':
      alert('You are redirected to Paypal.')
      default:
      break;
  }
}

resetManageBooking = () => {
  location.reload();
}

cancelTour = (id) => {
  Swal.fire({
    title: 'Tour Cancellation',
    text: "Cancel this tour?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, proceed to cancel'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: 'post',
        url: 'api/cancelTour.php',
        data: {
          email: sessionStorage.getItem('email'),
          reference_number: id
        },
        beforeSend: () => {
          $('.loading-spinner').css({'display':'flex'})
        },
        success: (response) => {
          if(response == 1){
            Swal.fire(
              'Tour Cancelled',
              "Your tour is successfully cancelled. Please contact Jomer Ventures to process your moneybacks.",
              'success'
            )

            $('.loading-spinner').css({'display':'none'});

            renderAPIs();
          }
        }
      })
    }
  })
  
}

nextStepReserve = (id) => {
  var booking_date = $('#reserve_date').val();
  var reserve_mode_payment = $('#reserve_mode_payment').val();

  if(booking_date == ''){
    
  }else{
    switch (reserve_mode_payment) {
      case 'GCASH':
        $.ajax({
          type: 'get',
          url: 'api/GcashReservation.php',
          data: {
            tourID: id
          },
          beforeSend: () => {
            $('.loading-spinner').css({'display':'flex'})
          },
          success: (response) => {
            $('.step1').css({'display':'none'})
            $('.step2').html(response)
            $('.step2').css({'display':'block'})
      
            $('.loading-spinner').css({'display':'none'})
          }
        })
        break;
      case 'PAYPAL':
        var email = $('#reserve_email').val();
        var phone = $('#reserve_phone').val();
        var fullname = $('#reserve_fullname').val();
        var date = $('#reserve_date').val();
        var persons = $('#reserve_persons').val();
        var pickup_point = $('#reserve_pickup_point').val();
    
        $.ajax({
          type: 'post',
          url: 'api/postPaypalReserve.php',
          data: {
            tourID: id,
            email: email,
            phone: phone,
            fullname: fullname,
            date: date,
            persons: persons,
            pickup_point: pickup_point,
            reserve_mode_payment: reserve_mode_payment,
          },
          beforeSend: () => {
            $('.loading-spinner').css({'display':'flex'});
          },
          success: (response) => {
            console.log(response);
            if(response == 1){
              Swal.fire({
                title: 'Reserve Successfully',
                text: "Your tour is waiting for your reservation fee payment. Please check your booking in manage bookings.",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Proceed'
              }).then((result) => {
                if (result.isConfirmed) {
                  location.reload();
                }
              })
            }
            $('.loading-spinner').css({'display':'none'});
          }
        })
        break;
      case 'CARD':
        var email = $('#reserve_email').val();
        var phone = $('#reserve_phone').val();
        var fullname = $('#reserve_fullname').val();
        var date = $('#reserve_date').val();
        var persons = $('#reserve_persons').val();
        var pickup_point = $('#reserve_pickup_point').val();
    
        $.ajax({
          type: 'post',
          url: 'api/postCardReserve.php',
          data: {
            tourID: id,
            email: email,
            phone: phone,
            fullname: fullname,
            date: date,
            persons: persons,
            pickup_point: pickup_point,
            reserve_mode_payment: reserve_mode_payment,
          },
          beforeSend: () => {
            $('.loading-spinner').css({'display':'flex'});
          },
          success: (response) => {
            console.log(response);
            if(response == 1){
              Swal.fire({
                title: 'Reserve Successfully',
                text: "Your tour is waiting for your reservation fee payment. Please check your booking in manage bookings.",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Proceed'
              }).then((result) => {
                if (result.isConfirmed) {
                  location.reload();
                }
              })
            }
            $('.loading-spinner').css({'display':'none'});
          }
        })
        break;
        break;
      default:
        break;
    }
  }
}

nextStepBook = (id) => {
  var booking_date = $('#reserve_date').val();
  var booking_mode_payment = $('#book_mode_payment').val();
  var pax = $('#book_persons').val();

  if(booking_date == ''){
    
  }else{
    switch (booking_mode_payment) {
      case 'GCASH':
        $.ajax({
          type: 'get',
          url: 'api/GcashBooking.php',
          data: {
            tourID: id,
            persons: pax
          },
          beforeSend: () => {
            $('.loading-spinner').css({'display':'flex'})
          },
          success: (response) => {
            $('.step1').css({'display':'none'})
            $('.step2').html(response)
            $('.step2').css({'display':'block'})
            $('.loading-spinner').css({'display':'none'})
          }
        })
        break;
      case 'PAYPAL':
        var email = $('#book_email').val();
        var phone = $('#book_phone').val();
        var fullname = $('#book_fullname').val();
        var date = $('#book_date').val();
        var persons = $('#book_persons').val();
        var pickup_point = $('#book_pickup_point').val();
        var book_payment_mode = $('#book_mode_payment').val();
    
        $.ajax({
          type: 'post',
          url: 'api/postPaypalBook.php',
          data: {
            tourID: id,
            email: email,
            phone: phone,
            fullname: fullname,
            date: date,
            persons: persons,
            pickup_point: pickup_point,
            book_payment_mode: book_payment_mode,
          },
          beforeSend: () => {
            $('.loading-spinner').css({'display':'flex'});
          },
          success: (response) => {
            console.log(response);
            if(response == 1){
              Swal.fire({
                title: 'Booked Successfully',
                text: "Your tour is waiting for your Paypal payment. Please check your booking in manage bookings.",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
              }).then((result) => {
                if (result.isConfirmed) {
                  location.reload();
                }
              })
            }
            $('.loading-spinner').css({'display':'none'});
          }
        })
        break;
      case 'CARD':
          var email = $('#book_email').val();
          var phone = $('#book_phone').val();
          var fullname = $('#book_fullname').val();
          var date = $('#book_date').val();
          var persons = $('#book_persons').val();
          var pickup_point = $('#book_pickup_point').val();
          var book_payment_mode = $('#book_mode_payment').val();
      
          $.ajax({
            type: 'post',
            url: 'api/postCardBook.php',
            data: {
              tourID: id,
              email: email,
              phone: phone,
              fullname: fullname,
              date: date,
              persons: persons,
              pickup_point: pickup_point,
              book_payment_mode: book_payment_mode,
            },
            beforeSend: () => {
              $('.loading-spinner').css({'display':'flex'});
            },
            success: (response) => {
              console.log(response);
              if(response == 1){
                Swal.fire({
                  title: 'Booked Successfully',
                  text: "Your tour is waiting for your Card payment. Please check your booking in manage bookings.",
                  icon: 'success',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'OK'
                }).then((result) => {
                  if (result.isConfirmed) {
                    location.reload();
                  }
                })
              }
              $('.loading-spinner').css({'display':'none'});
            }
          })
        // })
        break;
      default:
        break;
    }
  }
}


function book(id){
  var email;
  if(sessionStorage.getItem('email') != null){
    email = sessionStorage.getItem('email');
  }else {
    email = 'none';
  }
  $.ajax({
    type: 'get',
    url: 'api/getBookingDetails.php',
    data: {
      id: id,
      email: email
    },
    beforeSend: () => {
      $('.loading-spinner').css({'display':'flex'})
    },
    success: (response) => {
      $('#bookModal').css({'display':'flex'})
      $('#bookModal .bok-content').html(response)
      $('.loading-spinner').css({'display':'none'})
    }
  })
}

function reserve(id){
  var email;
  if(sessionStorage.getItem('email') != null){
    email = sessionStorage.getItem('email');
  }else {
    email = 'none';
  }
  $.ajax({
    type: 'get',
    url: 'api/getReservationDetails.php',
    data: {
      id: id,
      email: email
    },
    beforeSend: () => {
      $('.loading-spinner').css({'display':'flex'})
    },
    success: (response) => {
      $('#reserveModal').css({'display':'flex'})
      $('#reserveModal .bok-content').html(response)
      $('.loading-spinner').css({'display':'none'})
    }
  })
}

$(document).ready(function(){
  console.log(sessionStorage.getItem('email'))
  
  if(sessionStorage.getItem('email') != null){
    $.ajax({
      type: 'get',
      url: 'api/getUserData.php',
      data: {
        email: sessionStorage.getItem('email'),
      },
      success: (response) => {
        $('#account').html(response)
      }
    })
  }else {
    $('#account').html('<button onclick="openSignInModal()" class="button is-primary w-100">Sign In</button>')
  }
  $('#chatForm').submit(function(event){
    event.preventDefault();
    alert()
  })

  // Login Handler
  $('.signInForm').submit(function(event){
    event.preventDefault();

    var signinEmail = $('#signin_email').val();
    var signinPassword = $('#signin_password').val();

    $.ajax({
      type: 'get',
      url: 'api/login.php',
      data: {
        email: signinEmail,
        password: signinPassword,
      },
      beforeSend: () => {
        $('.loading-spinner').css({'display':'flex'})
      },
      success: (response) => {
        if(response == 1){
          Swal.fire({
            text: "You need to reload the page to complete the sign in process",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Reload the page.'
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload();
              sessionStorage.setItem('email', signinEmail)
            }
          })
        }

        if(response == 0){
          Swal.fire(
            'Login Failed',
            "Email and, password doesn't belong to a client",
            'error'
          )

          $('.loading-spinner').css({'display':'none'})
        }
      }
    })
  })
  $('#searchAgainForm').submit(function(event){
    event.preventDefault();

    var tour_month = $('#again_tour_month').val();
    var tour_destination = $('#again_tour_destination').val();

    $.ajax({
      type: 'get',
      url: 'api/getSearchedTour.php',
      data: {
        tour_month: tour_month,
        tour_destination: tour_destination
      },
      beforeSend: () => {
        $('.loading-spinner').css({'display':'flex'})
      },
      success: (response) => {
        $('.searched-tours').html(response)
        $('.loading-spinner').css({'display':'none'})
      }
    })
  })

  $('#searchTourForm').submit(function(event){
    event.preventDefault();

    var tour_month = $('#tour_month').val();
    var tour_destination = $('#tour_destination').val();

    $.ajax({
      type: 'get',
      url: 'api/getSearchedTour.php',
      data: {
        tour_month: tour_month,
        tour_destination: tour_destination
      },
      beforeSend: () => {
        $('.loading-spinner').css({'display':'flex'})
      },
      success: (response) => {
        $('.searched-tours').html(response)
        $('#again_tour_month').val(tour_month)
        $('#again_tour_destination').val(tour_destination)
        $('.loading-spinner').css({'display':'none'})
      }
    })
    $('#searchTour').css({'display':'flex'})
  })

  $('#signUpForm').submit(function(event){
    var signup_fullname = $('#signup_fullname').val();
    var signup_email = $('#signup_email').val();

    $.ajax({
      type: 'post',
      url: 'api/signup.php',
      data: {
        fullname: signup_fullname,
        email: signup_email
      },
      beforeSend: () => {
        $('.loading-spinner').css({'display':'flex'})
      },
      success: (response) => {
        if(response == 1){
          Swal.fire(
            'Registered Succeffully',
            "Please check your email inbox for the password. Thank you.",
            'success'
          )
          
          closeModal();
          $('.loading-spinner').css({'display':'none'})
          $('#signUpForm')[0].reset();
        }

        if(response == 0){
          Swal.fire(
            'Email is taken',
            "Please use another email address to signup",
            'warning'
          )
            
          $('#signUpForm')[0].reset();  
          $('.loading-spinner').css({'display':'none'})
        }
      }
    })
  })


  $('#accountSetupForm').submit(function(event){
    event.preventDefault();

    var new_password = $('#new_password').val();
    var new_phone = $('#new_phone').val();

    $.ajax({
      type: 'get',
      url: 'api/updateAccount.php',
      data: {
        email: sessionStorage.getItem('email'),
        password: new_password,
        phone: new_phone
      },
      beforeSend: () => {
        $('.loading-spinner').css({'display':'flex'})
      },
      success: (response) => {
        if(response == 1){
          Swal.fire({
            title: 'Account Settings Changed',
            text: "You need to reload the page to complete the process",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sure, reload the page.'
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload();
              sessionStorage.setItem('email', signinEmail)
            }
          })
        }
      }
    })
  })

})  

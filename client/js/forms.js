
// // SUBMIT BOOK PAYPAL
// bookPaypal = (id) => {
//   $(`[name='book${id}']`).submit(function(event){
//     event.preventDefault();
//     var email = $('#book_email').val();
//     var phone = $('#book_phone').val();
//     var fullname = $('#book_fullname').val();
//     var date = $('#book_date').val();
//     var persons = $('#book_persons').val();
//     var pickup_point = $('#book_pickup_point').val();
//     var book_payment_mode = $('#book_mode_payment').val();

//     $.ajax({
//       type: 'post',
//       url: 'api/postPaypalBook.php',
//       data: {
//         tourID: id,
//         email: email,
//         phone: phone,
//         fullname: fullname,
//         date: date,
//         persons: persons,
//         pickup_point: pickup_point,
//         book_payment_mode: book_payment_mode,
//       },
//       beforeSend: () => {
//         $('.loading-spinner').css({'display':'flex'});
//       },
//       success: (response) => {
//         console.log(response);
//         if(response == 1){
//           Swal.fire({
//             title: 'Booked Successfully',
//             text: "Your tour is waiting for your Paypal payment. Please check your booking in manage bookings.",
//             icon: 'success',
//             showCancelButton: true,
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             confirmButtonText: 'Proceed'
//           }).then((result) => {
//             if (result.isConfirmed) {
//               location.reload();
//             }
//           })
//         }

//         $('.loading-spinner').css({'display':'none'});
//       }
//     })
//   })
// }


searchReferenceNumber = () => {
  var manage_email = $('#manage_email').val();
    var manage_referenceNumber = $('#manage_referenceNumber').val();

    $.ajax({
      type: 'get',
      url: 'api/getMyBookings.php',
      data: {
        email: manage_email,
        reference_number: manage_referenceNumber
      },
      beforeSend: () => {
        $('.loading-spinner').css({'display':'flex'})
      },
      success: (response) => {
        $('#myBookings').html(response);
        $('.loading-spinner').css({'display':'none'})
        console.log(response);
      }
    })
} 

// SUBMIT BOOK PAYPAL
reservePaypal = (id) => {
  $(`[name='reservation${id}']`).submit(function(event){
    event.preventDefault();
    var email = $('#reserve_email').val();
    var phone = $('#reserve_phone').val();
    var fullname = $('#reserve_fullname').val();
    var date = $('#reserve_date').val();
    var persons = $('#reserve_persons').val();
    var pickup_point = $('#reserve_pickup_point').val();
    var reserve_mode_payment = $('#reserve_mode_payment').val();

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
        gcash_reference_number: gcash_reference_number,
        total_amount_paid: total_amount_paid
      },
      beforeSend: () => {
        $('.loading-spinner').css({'display':'flex'});
      },
      success: (response) => {
        if(response == 1){
          Swal.fire({
            title: 'Payment Successfully',
            text: "Reservation Fee is paid. It will take 3-5 days to process your payment",
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
  })
}


// SUBMIT RESERVE GCASH
reserveGCash = (id) => {
  $(`[name='reservation${id}']`).submit(function(event){
    event.preventDefault();
    var email = $('#reserve_email').val();
    var phone = $('#reserve_phone').val();
    var fullname = $('#reserve_fullname').val();
    var date = $('#reserve_date').val();
    var persons = $('#reserve_persons').val();
    var pickup_point = $('#reserve_pickup_point').val();
    var reserve_mode_payment = $('#reserve_mode_payment').val();
    var gcash_reference_number = $('#gcash_reference_number').val();
    var total_amount_paid = $('#total_amount_paid').val();

    $.ajax({
      type: 'post',
      url: 'api/postGcashReserve.php',
      data: {
        tourID: id,
        email: email,
        phone: phone,
        fullname: fullname,
        date: date,
        persons: persons,
        pickup_point: pickup_point,
        reserve_mode_payment: reserve_mode_payment,
        gcash_reference_number: gcash_reference_number,
        total_amount_paid: total_amount_paid
      },
      beforeSend: () => {
        $('.loading-spinner').css({'display':'flex'});
      },
      success: (response) => {
        if(response == 1){
          Swal.fire({
            title: 'Payment Successfully',
            text: "Reservation Fee is paid. It will take 3-5 days to process your payment",
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
  })
}

// SUBMIT BOOK GCASH
bookGCash = (id) => {
  $(`[name='book${id}']`).submit(function(event){
    event.preventDefault();
    var email = $('#book_email').val();
    var phone = $('#book_phone').val();
    var fullname = $('#book_fullname').val();
    var date = $('#book_date').val();
    var persons = $('#book_persons').val();
    var pickup_point = $('#book_pickup_point').val();
    var book_payment_mode = $('#book_mode_payment').val();
    var gcash_reference_number = $('#gcash_reference_number').val();
    var total_amount_paid = $('#total_amount_paid').val();

    $.ajax({
      type: 'post',
      url: 'api/postGcashBook.php',
      data: {
        tourID: id,
        email: email,
        phone: phone,
        fullname: fullname,
        date: date,
        persons: persons,
        pickup_point: pickup_point,
        book_payment_mode: book_payment_mode,
        gcash_reference_number: gcash_reference_number,
        total_amount_paid: total_amount_paid
      },
      beforeSend: () => {
        $('.loading-spinner').css({'display':'flex'});
      },
      success: (response) => {
        Swal.fire({
          title: 'Booked Successfully',
          text: "Please wait 24-48 hours to process your payment. Please check your email inbox.",
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

        $('.loading-spinner').css({'display':'none'});
      }
    })
  })
}

reserveGCashWithoutFee = (id) => {
  $(`[name='reservation${id}']`).submit(function(event){
    event.preventDefault();
    var email = $('#reserve_email').val();
    var phone = $('#reserve_phone').val();
    var fullname = $('#reserve_fullname').val();
    var date = $('#reserve_date').val();
    var persons = $('#reserve_persons').val();
    var pickup_point = $('#reserve_pickup_point').val();
    var reserve_mode_payment = $('#reserve_mode_payment').val();

    $.ajax({
      type: 'post',
      url: 'api/postGcashReserveWithoutFee.php',
      data: {
        tourID: id,
        email: email,
        phone: phone,
        fullname: fullname,
        date: date,
        persons: persons,
        pickup_point: pickup_point,
        reserve_mode_payment: reserve_mode_payment
      },
      beforeSend: () => {
        $('.loading-spinner').css({'display':'flex'});
      },
      success: (response) => {
        console.log(response)
        $('.loading-spinner').css({'display':'none'});
      }
    })
  })
}


$(document).ready(function(){
  $('.forgotPasswordForm').submit(function(event){
    event.preventDefault();

    var email = $('#forgot_email').val();

    $.ajax({
      type: 'get',
      url: 'api/forgotPassword.php',
      data: {
        email: email
      },
      beforeSend: () => {
        $('.loading-spinner').css({'display':'flex'})
      },
      success: (response) => {
        $('.loading-spinner').css({'display':'none'})

        if(response == 1){
          Swal.fire(
            'Temporary Password Sent Successfully',
            "A temporary password was sent to your email. Please check your inbox",
            'success'
          )
        }
        
      }
    })
  })
})
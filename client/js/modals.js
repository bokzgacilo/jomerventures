// CLOSE AND OPEN OF MODALS

function openSignInModal(){
  closeModal();
  $('#signInModal').css({'display':'flex'})
}

function openSignUpModal(){
  closeModal();
  $('#signUpModal').css({'display':'flex'})
}

function continueAsMember(){
  closeModal();
  openSignInModal();
}

function closeModal(){
  $('.bok-modal').css({'display':'none'})
}

closeUpdateModal = () => {
  $('.updModal').css({'display':'none'})
}

openForgotPassword = () => {
   closeModal();
  $('#forgotPassword').css({'display':'flex'})
}

function openChat(){
  $('.chat-support').removeClass('closed-chat');
  $('#chat-button-controller').removeClass('fa-chevron-up');
  $('#chat-button-controller').addClass('fa-chevron-down');
  $('.chat-support').addClass('open-chat');
  $('.chat-body').css({'display':'flex'})

  $(".chat-support").animate({
    width: '22vw',
    height: '70vh'
  }, 150);
}

function closeChat(){
  $('.chat-support').removeClass('open-chat');
  $('#chat-button-controller').removeClass('fa-chevron-down');
  $('#chat-button-controller').addClass('fa-chevron-up');
  $('.chat-body').css({'display':'none !important'});
  $('.chat-support').addClass('closed-chat');
  $(".chat-support").animate({
    width: '15vw',
    height: '5vh'
  }, 150);
}


updateTravelDate = (tourID) => {
  $.ajax({
    type: 'get',
    url: 'api/getTravelDate.php',
    data: {
      tourID: tourID
    },
    beforeSend: () => {
      $('.loading-spinner').css({'display':'flex'})
    },
    success: (response) => {
      $('#travelDateDiv').css({'display':'flex'})

      $('#travelDate').html(response)

      $('.loading-spinner').css({'display':'none'})
    }
  })
}

updatePickupPoint = (tourID) => {
  $.ajax({
    type: 'get',
    url: 'api/getPickupPoint.php',
    data: {
      tourID: tourID
    },
    beforeSend: () => {
      $('.loading-spinner').css({'display':'flex'})
    },
    success: (response) => {
      $('#pickupPointDiv').css({'display':'flex'})

      $('#pickupPoint').html(response)

      $('.loading-spinner').css({'display':'none'})
    }
  })

}

updateGuestDetails = (tourID) => {
  $('#guestDetailsDiv').css({'display':'flex'})
}

openAccountSetting = () => {
  $('#accountSetting').css({'display':'flex'})
}


closeBooking = () => {
  $('#bookModal').css({'display':'none'})
  $('#bookModal .bok-content').html("")
}

closeReservation = () => {
  $('#reserveModal').css({'display':'none'})
  $('#reserveModal .bok-content').html("")
}

handleSignOut = () => {
  Swal.fire({
    title: 'Signing out?',
    text: "Don't worry, you can come back anytime.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes.'
  }).then((result) => {
    if (result.isConfirmed) {
      sessionStorage.removeItem('email');
      location.reload();
    }
  })
}

function openManageBookings() {
  $('#manageBooking').css({'display':'flex'})
}

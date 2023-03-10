function getAllTourPackages() {
  $.ajax({
    type: 'get',
    url: 'api/getAllTourPackages.php',
    success: (response) => {
      $('.tours').html(response);
    }
  })
}

function getAllFaqs() {
  $.ajax({
    type: 'get',
    url: 'api/getAllFaqs.php',
    success: (response) => {
      $('.chat-body').html(response);
    }
  })
}

function getMyBookings() {
  if(sessionStorage.getItem('email') != null){
    // alert('signed');
    $.ajax({
      type: 'get',
      url: 'api/getAllMyBookings.php',
      data: {
        email: sessionStorage.getItem('email')
      },
      success: (response) => {
        $('#myBookings').html(response);
      }
    })
  }else {
    // alert('not signed');
  }
}

function getAccountSetting(){
  $.ajax({
    type: 'get',
    url: 'api/getAccountSettings.php',
    data: {
      email: sessionStorage.getItem('email')
    },
    success: (response) => {
      $('#accountSetupForm').html(response)
    }
  })
}

function openTourDetail(id){
  $.ajax({
    type: 'get',
    url: 'api/getTourDetail.php',
    data: {
      id: id
    },
    beforeSend: () => {
      $('.loadin-spinner').css({'display':'flex'})
    },
    success: (response) => {
      $('#tourDetail').css({'display':'flex'})
      $('#tourDetail .bok-content').html(response)
      $('.loadin-spinner').css({'display':'flex'})
    }
  })
}

function changeBanner(id){
  $('.tour').removeClass('is-active')
  $.ajax({
    type: 'get',
    url: 'api/getTourCardDetail.php',
    data: {
      location: id
    },
    beforeSend: () => {
      $('.loading-spinner').css({'display':'flex'})
    },
    success: (response) => {
      $.ajax({
        type: 'get',
        url: 'api/getTourPicture.php',
        data: {id: id},
        success: (response2) => {
          $('.tour-banner').css({
            'background':'url(../admin/POST/'+response2+')',
            'height': 'inherit',
            'width': '70vw',
            'background-size': 'cover',
            'background-position':' center'
          })
        }
      })
    
      $('.tour-banner').html(response);
      $('.loading-spinner').css({'display':'none'})
    }
  })

  $(`#${id}`).addClass('is-active');
}

function getAllTourCards(){
  $.ajax({
    type: 'get',
    url: 'api/getCarouselItems.php',
    success: (response) => {
      $('#packages-carousel').html(response)
    }
  })
}

function getFirstTour() {
  $.ajax({
    type: 'get',
    url: 'api/getFirstTour.php',
    success: (response) => {
      $('.tour-banner').css({
        'background':"url(../admin/POST/"+response+")",
        'height': 'inherit',
        'width': '70vw',
        'background-size': 'cover',
        'background-position':' center'
      })

      $.ajax({
        type: 'get',
        url: 'api/getFirstCardDetail.php',
        success: (response2) => {
          $('.tour-banner').html(response2);
        }
      })
    }
  })
}

function renderAPIs(){
  getAllTourPackages();
  getFirstTour();
  getAllTourCards();
  getAccountSetting();
  getAllFaqs();
  getMyBookings();
}

$(document).ready(function(){
  renderAPIs();
})
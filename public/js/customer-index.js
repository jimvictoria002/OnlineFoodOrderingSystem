const showNav = document.getElementById('nav-toggle');
const menuWrapper = document.getElementById('menuWrapper');

showNav.addEventListener('click', () => {
    const computedStyle = window.getComputedStyle(menuWrapper);
    const leftValue = computedStyle.getPropertyValue('left');
    const padding = computedStyle.getPropertyValue('padding');

    if (leftValue === '0px') {
        menuWrapper.style.left = '-110%';
        menuWrapper.style.right = '100%';
    } else {
        menuWrapper.style.left = '0';
        menuWrapper.style.right = '0';
    }
});

let productCon = document.getElementsByClassName('product-container');

for (let i = 0; i < productCon.length; i++) {
  var swiperOptions = {
    slidesPerView: 3,
    spaceBetween: 60,
    
    grabCursor: true,
    pagination: {
      el: ".swiper-pagination" + i,
      clickable: true,
      dynamicBullets: true,
    },
    navigation: {
      nextEl: ".swiper-button-next" + i,
      prevEl: ".swiper-button-prev" + i,
    },
    breakpoints: {
      0: {
        spaceBetween: 20,
        slidesPerView: 2,
      },
      600: {
        slidesPerView: 3,
      },
      950: {
        slidesPerView: 3,
      },
    },
  };

  if (i === 0) {
    swiperOptions.slidesPerGroup = 3;
    swiperOptions.spaceBetween = 50;
    swiperOptions.loop = true
    swiperOptions.breakpoints = {
      0: {
        spaceBetween: 20,
        slidesPerView: 2,
      },

      600: {
        slidesPerView: 2,
      },
      950: {
        slidesPerView: 3,
      },
    }
    swiperOptions.autoplay = {
      delay: 2500,
      disableOnInteraction: false,
    };
  }

  var swiper = new Swiper(".mySwiper" + i, swiperOptions);
}


let profileToggle = document.getElementById('profile-toggle');
let profileDropdown = document.getElementById('profileDropdown');

profileToggle.addEventListener('click', ()=>{
  if(profileDropdown.style.display == "flex"){
    profileDropdown.style.display = "none";
  }else{
    profileDropdown.style.display = "flex";
  }
});


function updateLocation(selectElement) {
  var selectedValue = selectElement.value;
  if (selectedValue) {
      window.location.href = selectedValue;
  }
}


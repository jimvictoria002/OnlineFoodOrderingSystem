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


let categoryOpen = document.getElementById('category-toggle-open');
let categoryClose = document.getElementById('category-toggle-close');
let categoryContainer = document.getElementById('addCategory');


categoryOpen.addEventListener('click', ()=>{
  categoryContainer.style.bottom = 0;
});

categoryClose.addEventListener('click', ()=>{
  categoryContainer.style.bottom = '100%';
});

let deleteCategoryOpen = document.getElementById('deleteCategory-toggle-open');
let deleteCategoryClose = document.getElementById('delete-category-toggle-close');
let deleteCategoryContainer = document.getElementById('deleteCategory');


deleteCategoryOpen.addEventListener('click', ()=>{
  deleteCategoryContainer.style.bottom = 0;
      
      
  var myInput = document.querySelector('.category-upt-input');
  myInput.focus();
  myInput.setSelectionRange(myInput.value.length, myInput.value.length);
});

deleteCategoryClose.addEventListener('click', ()=>{
  deleteCategoryContainer.style.bottom = '100%';
});



let profileToggle = document.getElementById('profile-toggle');
let profileDropdown = document.getElementById('profileDropdown');

profileToggle.addEventListener('click', ()=>{
  if(profileDropdown.style.display == "flex"){
    profileDropdown.style.display = "none";
  }else{
    profileDropdown.style.display = "flex";
  }
});




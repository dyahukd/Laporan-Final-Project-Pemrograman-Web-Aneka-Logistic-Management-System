AOS.init({
  duration: 900,
  once: true
});

// HERO SLIDER OTOMATIS 
const slides = document.querySelectorAll('.hero-slide');
let currentSlide = 0;

if (slides.length > 0) {
  setInterval(() => {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add('active');
  }, 5000); // ganti slide setiap 5 detik
}

// ANIMASI COUNTER STATS 
const counters = document.querySelectorAll('.counter');
let statsStarted = false;

function startCounters() {
  counters.forEach(counter => {
    const target = +counter.dataset.target;

    const update = () => {
      const current = +counter.innerText.replace(/\D/g, '') || 0;
      const increment = target / 100;

      if (current < target) {
        counter.innerText = Math.ceil(current + increment);
        setTimeout(update, 20);
      } else {
        counter.innerText = target.toLocaleString('id-ID');
      }
    };

    update();
  });
}

window.addEventListener('scroll', () => {
  const statsSection = document.getElementById('stats');
  if (!statsSection || statsStarted) return;

  const rect = statsSection.getBoundingClientRect();
  if (rect.top < window.innerHeight) {
    statsStarted = true;
    startCounters();
  }
});

// MAP + LOCATION TOGGLE
const mapUrls = {
  Surabaya: "https://www.google.com/maps?q=Jl.+Greges+Jaya+II+No.Blok+B11,+Surabaya&output=embed",
  Balikpapan: "https://www.google.com/maps?q=Aneka+Logistic+Balikpapan&output=embed",
  Jakarta: "https://www.google.com/maps?q=Jakarta&output=embed",
  Kupang: "https://www.google.com/maps?q=Kupang&output=embed"
};

const locationItems = document.querySelectorAll('.location-item');
const mainMap = document.getElementById('mainMap');

locationItems.forEach(item => {
  const title = item.querySelector('.location-title');
  const city = item.dataset.city;

  if (city && mapUrls[city] && mainMap && item.classList.contains('active')) {
    mainMap.src = mapUrls[city];
  }

  title.addEventListener('click', () => {
    const alreadyActive = item.classList.contains('active');

    locationItems.forEach(other => {
      other.classList.remove('active');
      const span = other.querySelector('.location-title span');
      if (span) span.textContent = '+';
    });

    
    if (!alreadyActive) {
      item.classList.add('active');
      const span = item.querySelector('.location-title span');
      if (span) span.textContent = '−';

      if (city && mapUrls[city] && mainMap) {
        mainMap.src = mapUrls[city];
      }
    } else {
      const span = item.querySelector('.location-title span');
      if (span) span.textContent = '+';
    }
  });
});

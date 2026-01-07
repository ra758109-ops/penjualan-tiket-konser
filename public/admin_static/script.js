document.addEventListener('DOMContentLoaded', function() {
    const sliderContainer = document.querySelector('.slider-container');
    const slides = document.querySelectorAll('.slide');
    const prevArrow = document.querySelector('.prev');
    const nextArrow = document.querySelector('.next');
    const sliderDots = document.querySelector('.slider-dots');
    
    let currentIndex = 0;
    const totalSlides = slides.length;
    let slideInterval; // Variabel untuk menyimpan interval otomatis

    // 1. Buat Indikator Titik (Dots)
    function createDots() {
        for (let i = 0; i < totalSlides; i++) {
            const dot = document.createElement('span');
            dot.classList.add('dot');
            if (i === 0) {
                dot.classList.add('active');
            }
            dot.addEventListener('click', () => {
                goToSlide(i);
                resetAutoSlide();
            });
            sliderDots.appendChild(dot);
        }
    }

        // 2. Fungsi Utama untuk Pindah Slide
    function goToSlide(index) {
        if (index < 0) {
            index = totalSlides - 1; // Kembali ke slide terakhir
        } else if (index >= totalSlides) {
            index = 0; // Kembali ke slide pertama
        }

        currentIndex = index;
        
        // Geser container
        const offset = -currentIndex * 100;
        sliderContainer.style.transform = `translateX(${offset}%)`;

        // Update kelas active pada dots dan slide
        updateDots();
    }
    // 3. Update Status Active pada Dots
    function updateDots() {
        const dots = document.querySelectorAll('.dot');
        
        // Hapus kelas active dari semua slide dan dots
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));

        // Tambahkan kelas active ke slide dan dot yang sesuai
        slides[currentIndex].classList.add('active');
        dots[currentIndex].classList.add('active');
    }

    // 4. Navigasi dengan Panah
    prevArrow.addEventListener('click', () => {
        goToSlide(currentIndex - 1);
        resetAutoSlide();
    });

    nextArrow.addEventListener('click', () => {
        goToSlide(currentIndex + 1);
        resetAutoSlide();
    });

    // 5. Auto Slide (Interval Otomatis)
    function startAutoSlide() {
        slideInterval = setInterval(() => {
            goToSlide(currentIndex + 1);
        }, 5000); // Ganti slide setiap 5 detik (5000 ms)
    }

    // 6. Reset Timer saat ada interaksi user
    function resetAutoSlide() {
        clearInterval(slideInterval);
        startAutoSlide();
    }

    // --- Inisialisasi ---
    createDots();
    startAutoSlide();
});
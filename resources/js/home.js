// Theme Toggle
class ThemeManager {
    constructor() {
        this.theme = localStorage.getItem('theme') || 'light';
        this.init();
    }

    init() {
        this.setTheme(this.theme);
        this.bindEvents();
    }

    setTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        this.updateToggleButton(theme);
    }

    updateToggleButton(theme) {
        const button = document.querySelector('.theme-toggle i');
        if (button) {
            button.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
        }
    }

    toggleTheme() {
        this.theme = this.theme === 'light' ? 'dark' : 'light';
        this.setTheme(this.theme);
    }

    bindEvents() {
        document.querySelector('.theme-toggle')?.addEventListener('click', () => {
            this.toggleTheme();
        });
    }
}

// Typing Effect
class TypingEffect {
    constructor(element, texts, speed = 100) {
        this.element = element;
        this.texts = texts;
        this.speed = speed;
        this.textIndex = 0;
        this.charIndex = 0;
        this.isDeleting = false;
        this.init();
    }

    init() {
        this.type();
    }

    type() {
        const currentText = this.texts[this.textIndex];
        
        if (this.isDeleting) {
            this.charIndex--;
        } else {
            this.charIndex++;
        }

        this.element.innerHTML = currentText.substring(0, this.charIndex) + 
            '<span class="typing-text"></span>';

        let typeSpeed = this.speed;

        if (this.isDeleting) {
            typeSpeed /= 2;
        }

        if (!this.isDeleting && this.charIndex === currentText.length) {
            typeSpeed = 2000;
            this.isDeleting = true;
        } else if (this.isDeleting && this.charIndex === 0) {
            this.isDeleting = false;
            this.textIndex = (this.textIndex + 1) % this.texts.length;
            typeSpeed = 500;
        }

        setTimeout(() => this.type(), typeSpeed);
    }
}

// Scroll Animations
class ScrollAnimator {
    constructor() {
        this.elements = document.querySelectorAll('.fade-in');
        this.init();
    }

    init() {
        this.checkScroll();
        window.addEventListener('scroll', () => this.checkScroll());
    }

    checkScroll() {
        const triggerBottom = window.innerHeight * 0.8;
        
        this.elements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            
            if (elementTop < triggerBottom) {
                element.classList.add('visible');
            }
        });
    }
}

// Morphing Background
class MorphingBackground {
    constructor(container) {
        this.container = container;
        this.elements = [];
        this.init();
    }

    init() {
        this.createElements();
        this.animate();
    }

    createElements() {
        for (let i = 0; i < 5; i++) {
            const element = document.createElement('div');
            element.className = 'morphing-element';
            
            const size = Math.random() * 200 + 100;
            element.style.width = `${size}px`;
            element.style.height = `${size}px`;
            element.style.left = `${Math.random() * 100}%`;
            element.style.top = `${Math.random() * 100}%`;
            element.style.animationDelay = `${Math.random() * 5}s`;
            
            this.container.appendChild(element);
            this.elements.push(element);
        }
    }

    animate() {
        this.elements.forEach(element => {
            element.style.transform = `translate(${Math.random() * 50 - 25}px, ${Math.random() * 50 - 25}px)`;
        });
        
        setTimeout(() => this.animate(), 8000);
    }
}

// Initialize Everything when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Theme Manager
    new ThemeManager();

    // Typing Effect
    const typingElement = document.getElementById('typing-text');
    if (typingElement) {
        const texts = [
            'Full Stack Developer',
            'UI/UX Designer',
            'Laravel Expert',
            'Vue.js Specialist',
            'Problem Solver'
        ];
        new TypingEffect(typingElement, texts, 100);
    }

    // Scroll Animations
    new ScrollAnimator();

    // Morphing Background
    const heroBg = document.querySelector('.hero-bg');
    if (heroBg) {
        new MorphingBackground(heroBg);
    }

    // Animate Progress Bars on scroll
    const progressBars = document.querySelectorAll('.progress-bar');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const width = entry.target.style.width;
                entry.target.style.width = '0';
                setTimeout(() => {
                    entry.target.style.width = width;
                }, 300);
            }
        });
    });

    progressBars.forEach(bar => observer.observe(bar));
});
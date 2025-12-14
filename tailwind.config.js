/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx,vue,php}",
    "./resources/**/*.blade.php",
    "./**/*.{html,php}",
  ],
  theme: {
    extend: {
      keyframes: {
        // Gerak ke Kiri (Normal)
        scrollLeft: {
          '0%': { transform: 'translateX(0)' },
          '100%': { transform: 'translateX(-50%)' },
        },
        // Gerak ke Kanan (Reverse)
        scrollRight: {
          '0%': { transform: 'translateX(-50%)' }, // Mulai dari tengah
          '100%': { transform: 'translateX(0)' },   // Geser ke posisi awal
        },
      },
      animation: {
        'scroll-left': 'scrollLeft 15s linear infinite',
        'scroll-right': 'scrollRight 15s linear infinite',
      },
    },
  },
  plugins: [],
}
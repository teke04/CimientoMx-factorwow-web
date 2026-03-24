module.exports = {
  darkMode: 'class', // Forzar modo oscuro con clase, ignorando preferencias del sistema
  content: [
      './recursos/tailwind/*',
      './vistas/**/*',
      './framework/vistas/**/*',
  ],
  theme: {
      extend: {
          colors: {
              admin:{
                    'primario-1': '#3b065a',
                    'primario-2': '#3b065a',
                    'secundario-1': '#086ABA',
                    'secundario-2': '#05C3F9',
                    'complementario-1': '#F2A365',
                    'complementario-2': '#F25C54',
                },
                teven:{
                    'primario': '#50388E',
                    'secundario-1': '#4D4897',
                    'secundario-2': '#754F9B',
                    'secundario-3': '#432683',
                    'complementario': '#454FE0',
                },
                web:{
                    
                },
                landing:{
                    
                },
          },
          backgroundImage: {
              'degradado-1': 'linear-gradient(to top, #5F3D7C, #8867A4)',
          },
          fontFamily: {
              inter : ['Inter', 'sans-serif'],
          },
          fontWeight: {
              bold: '700',
          },
          fontSize: {
              h1: '48px',
              h2: '36px',
              h3: '28px',
              btn: '20px',
          },
          animation: {
              'ping-slow': 'ping 2s infinite',
              'scale-pulse': 'scale-pulse 4s infinite',
          },
          keyframes: {
              'scale-pulse': {
                '0%, 100%': { transform: 'scale(1)' },
                '50%': { transform: 'scale(1.3)' },
              },
          },
      },
  },
  plugins: [],
};
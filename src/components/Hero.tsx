import { ArrowDown, Linkedin, Mail, Phone } from 'lucide-react';
import { useEffect, useRef, useState } from 'react';

export default function Hero() {
  const [animKey, setAnimKey] = useState(0);
  const sectionRef = useRef<HTMLElement>(null);
  const hasInitialized = useRef(false);

  useEffect(() => {
    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          if (hasInitialized.current) {
            // Re-trigger entrance animation on each return to top
            setAnimKey((k) => k + 1);
          } else {
            hasInitialized.current = true;
          }
        }
      },
      { threshold: 0.85 }
    );
    if (sectionRef.current) observer.observe(sectionRef.current);
    return () => observer.disconnect();
  }, []);

  const ringConfig = [
    { size: 440,  borderOpacity: 0.40, pulseSpeed: 5.0, pulseDelay: 0.00, dots: [{ dur: 14, cw: true,  startAngle: 0,   dotSize: 6   }] },
    { size: 660,  borderOpacity: 0.30, pulseSpeed: 5.4, pulseDelay: 0.55, dots: [{ dur: 22, cw: false, startAngle: 0,   dotSize: 5   }, { dur: 22, cw: false, startAngle: 180, dotSize: 5 }] },
    { size: 880,  borderOpacity: 0.22, pulseSpeed: 5.8, pulseDelay: 1.10, dots: [{ dur: 32, cw: true,  startAngle: 90,  dotSize: 5   }] },
    { size: 1100, borderOpacity: 0.14, pulseSpeed: 6.2, pulseDelay: 1.65, dots: [{ dur: 44, cw: false, startAngle: 45,  dotSize: 4   }, { dur: 44, cw: false, startAngle: 225, dotSize: 4 }] },
    { size: 1320, borderOpacity: 0.08, pulseSpeed: 6.6, pulseDelay: 2.20, dots: [{ dur: 58, cw: true,  startAngle: 135, dotSize: 3.5 }] },
    { size: 1540, borderOpacity: 0.04, pulseSpeed: 7.0, pulseDelay: 2.75, dots: [] },
  ];

  return (
    <section
      ref={sectionRef}
      className="relative min-h-screen flex items-center justify-center bg-slate-900 overflow-hidden"
    >
      {/* Dot-grid texture */}
      <div
        className="absolute inset-0 pointer-events-none"
        style={{
          backgroundImage:
            'radial-gradient(circle, rgba(148,163,184,0.07) 1px, transparent 1px)',
          backgroundSize: '32px 32px',
        }}
      />

      {/* Aurora orbs — GPU composited, zero CPU cost */}
      <div className="absolute inset-0 pointer-events-none overflow-hidden">
        {/* Orb 1 – large blue, top-left */}
        <div
          className="absolute rounded-full"
          style={{
            width: '680px',
            height: '680px',
            top: '-180px',
            left: '-120px',
            background:
              'radial-gradient(circle, rgba(37,99,235,0.22) 0%, transparent 68%)',
            filter: 'blur(64px)',
            animation: 'orb-float-1 20s ease-in-out infinite',
          }}
        />
        {/* Orb 2 – indigo, bottom-right */}
        <div
          className="absolute rounded-full"
          style={{
            width: '560px',
            height: '560px',
            bottom: '-120px',
            right: '-80px',
            background:
              'radial-gradient(circle, rgba(79,70,229,0.18) 0%, transparent 68%)',
            filter: 'blur(56px)',
            animation: 'orb-float-2 26s ease-in-out infinite',
          }}
        />
        {/* Orb 3 – teal accent, upper-right */}
        <div
          className="absolute rounded-full"
          style={{
            width: '380px',
            height: '380px',
            top: '15%',
            right: '12%',
            background:
              'radial-gradient(circle, rgba(6,182,212,0.13) 0%, transparent 68%)',
            filter: 'blur(44px)',
            animation: 'orb-float-3 17s ease-in-out infinite',
          }}
        />
        {/* Orb 4 – soft blue, lower-left */}
        <div
          className="absolute rounded-full"
          style={{
            width: '320px',
            height: '320px',
            bottom: '20%',
            left: '8%',
            background:
              'radial-gradient(circle, rgba(59,130,246,0.14) 0%, transparent 68%)',
            filter: 'blur(40px)',
            animation: 'orb-float-1 28s ease-in-out 6s infinite reverse',
          }}
        />
      </div>

      {/* Concentric rings with orbiting dots */}
      <div className="absolute inset-0 overflow-hidden pointer-events-none">
        {ringConfig.map(({ size, borderOpacity, pulseSpeed, pulseDelay, dots }, i) => (
          <span key={i}>
            {/* Ring border */}
            <div
              className="absolute rounded-full"
              style={{
                width: `${size}px`,
                height: `${size}px`,
                top: '50%',
                left: '50%',
                border: `1px solid rgba(96,165,250,${borderOpacity})`,
                animation: `ring-pulse ${pulseSpeed}s ease-in-out ${pulseDelay}s infinite`,
              }}
            />
            {/* Orbiting dots for this ring */}
            {dots.map(({ dur, cw, startAngle, dotSize }, j) => (
              <div
                key={j}
                style={{
                  position: 'absolute',
                  width: `${size}px`,
                  height: `${size}px`,
                  top: '50%',
                  left: '50%',
                  animation: `${cw ? 'orbit-cw' : 'orbit-ccw'} ${dur}s linear ${-(startAngle / 360) * dur}s infinite`,
                }}
              >
                <div
                  style={{
                    position: 'absolute',
                    width: `${dotSize}px`,
                    height: `${dotSize}px`,
                    top: `-${dotSize / 2}px`,
                    left: `calc(50% - ${dotSize / 2}px)`,
                    borderRadius: '50%',
                    backgroundColor: 'rgba(147,197,253,0.92)',
                    boxShadow: `0 0 ${dotSize * 2.5}px ${dotSize * 1.2}px rgba(96,165,250,0.45)`,
                  }}
                />
              </div>
            ))}
          </span>
        ))}
      </div>

      {/* Content — key prop restarts all CSS animations on each hero re-entry */}
      <div key={animKey} className="relative text-center px-6 max-w-4xl mx-auto">
        <div
          style={{ animation: 'fade-up 0.7s cubic-bezier(0.16,1,0.3,1) 0ms both' }}
          className="inline-flex items-center gap-2 bg-blue-600/10 border border-blue-500/20 rounded-full px-4 py-1.5 text-blue-400 text-sm font-medium mb-8"
        >
          <span className="w-2 h-2 rounded-full bg-blue-400 animate-pulse" />
          Available for new opportunities
        </div>

        <h1
          style={{ animation: 'fade-up 0.7s cubic-bezier(0.16,1,0.3,1) 150ms both' }}
          className="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight tracking-tight"
        >
          Andrew
          <br />
          <span className="text-blue-400">McMorrow</span>
        </h1>

        <p
          style={{ animation: 'fade-up 0.7s cubic-bezier(0.16,1,0.3,1) 300ms both' }}
          className="text-xl md:text-2xl text-slate-400 font-medium mb-4"
        >
          Digital Marketing & E-commerce Strategist
        </p>

        <p
          style={{ animation: 'fade-up 0.7s cubic-bezier(0.16,1,0.3,1) 420ms both' }}
          className="text-slate-500 text-base md:text-lg max-w-2xl mx-auto mb-10 leading-relaxed"
        >
          Over two decades of experience driving growth through data-driven campaigns,
          UX optimization, and cross-functional e-commerce strategy.
        </p>

        <div
          style={{ animation: 'fade-up 0.7s cubic-bezier(0.16,1,0.3,1) 550ms both' }}
          className="flex flex-col sm:flex-row items-center justify-center gap-4 mb-14"
        >
          <a
            href="#experience"
            className="bg-blue-600 hover:bg-blue-500 active:scale-[0.97] hover:scale-[1.02] text-white font-semibold px-8 py-3.5 rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-blue-600/25 w-full sm:w-auto text-center"
          >
            View My Work
          </a>
          <a
            href="#contact"
            className="border border-slate-700 hover:border-slate-500 active:scale-[0.97] hover:scale-[1.02] text-slate-300 hover:text-white font-semibold px-8 py-3.5 rounded-xl transition-all duration-200 w-full sm:w-auto text-center"
          >
            Get in Touch
          </a>
        </div>

        <div
          style={{ animation: 'fade-up 0.7s cubic-bezier(0.16,1,0.3,1) 680ms both' }}
          className="flex items-center justify-center gap-6"
        >
          <a
            href="mailto:amcmorrow84@proton.me"
            className="text-slate-500 hover:text-blue-400 hover:scale-110 transition-all duration-200"
            aria-label="Email"
          >
            <Mail size={20} />
          </a>
          <a
            href="https://www.linkedin.com/in/andrew-mcmorrow"
            target="_blank"
            rel="noopener noreferrer"
            className="text-slate-500 hover:text-blue-400 hover:scale-110 transition-all duration-200"
            aria-label="LinkedIn"
          >
            <Linkedin size={20} />
          </a>
          <a
            href="tel:6123848959"
            className="text-slate-500 hover:text-blue-400 hover:scale-110 transition-all duration-200"
            aria-label="Phone"
          >
            <Phone size={20} />
          </a>
        </div>
      </div>

      <div
        className="absolute bottom-8 left-1/2 -translate-x-1/2"
        style={{ animation: 'fade-up 0.7s cubic-bezier(0.16,1,0.3,1) 900ms both' }}
      >
        <a
          href="#about"
          className="text-slate-600 hover:text-slate-400 transition-colors animate-bounce block"
          aria-label="Scroll down"
        >
          <ArrowDown size={22} />
        </a>
      </div>
    </section>
  );
}

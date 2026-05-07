import { useState, useEffect } from 'react';
import { Menu, X } from 'lucide-react';

const links = [
  { label: 'About', href: '#about' },
  { label: 'Experience', href: '#experience' },
  { label: 'Projects', href: '#projects' },
  { label: 'Contact', href: '#contact' },
  { label: 'Resume', href: '/resume/' },
];

export default function Nav() {
  const [open, setOpen] = useState(false);
  const [scrolled, setScrolled] = useState(false);

  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > 20);
    window.addEventListener('scroll', onScroll);
    return () => window.removeEventListener('scroll', onScroll);
  }, []);

  return (
    <header
      className={`fixed top-0 left-0 right-0 z-50 transition-all duration-300 ${
        scrolled ? 'bg-slate-900/95 backdrop-blur-sm shadow-lg' : 'bg-transparent'
      }`}
    >
      <div className="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
        <a href="#" className="text-white font-bold text-xl tracking-tight">
          Andrew<span className="text-blue-400">.</span>
        </a>

        <nav className="hidden md:flex items-center gap-8">
          {links.map((l) => (
            <a
              key={l.href}
              href={l.href}
              className="text-slate-300 hover:text-white text-sm font-medium transition-colors duration-200"
            >
              {l.label}
            </a>
          ))}
          <a
            href="#contact"
            className="bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors duration-200"
          >
            Hire Me
          </a>
        </nav>

        <button
          className="md:hidden text-white p-1"
          onClick={() => setOpen(!open)}
          aria-label="Toggle menu"
        >
          {open ? <X size={22} /> : <Menu size={22} />}
        </button>
      </div>

      {open && (
        <div className="md:hidden bg-slate-900 border-t border-slate-800 px-6 py-4 flex flex-col gap-4">
          {links.map((l) => (
            <a
              key={l.href}
              href={l.href}
              onClick={() => setOpen(false)}
              className="text-slate-300 hover:text-white text-sm font-medium transition-colors"
            >
              {l.label}
            </a>
          ))}
          <a
            href="mailto:amcmorrow84@proton.me"
            className="bg-blue-600 text-white text-sm font-semibold px-4 py-2 rounded-lg text-center"
          >
            Hire Me
          </a>
        </div>
      )}
    </header>
  );
}

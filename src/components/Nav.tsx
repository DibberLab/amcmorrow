import { useState, useEffect } from 'react';
import { Link, useLocation } from 'react-router-dom';
import { Menu, X } from 'lucide-react';

const links = [
  { label: 'About', to: '/#about' },
  { label: 'Experience', to: '/#experience' },
  { label: 'Projects', to: '/#projects' },
  { label: 'Contact', to: '/#contact' },
  { label: 'Resume', to: '/resume' },
];

export default function Nav() {
  const [open, setOpen] = useState(false);
  const [scrolled, setScrolled] = useState(false);
  const { pathname } = useLocation();
  const solidBg = scrolled || pathname !== '/';

  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > 20);
    window.addEventListener('scroll', onScroll);
    return () => window.removeEventListener('scroll', onScroll);
  }, []);

  return (
    <header
      className={`fixed top-0 left-0 right-0 z-50 transition-all duration-300 ${
        solidBg ? 'bg-slate-900/95 backdrop-blur-sm shadow-lg' : 'bg-transparent'
      }`}
    >
      <div className="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
        <Link to="/" className="text-white font-bold text-xl tracking-tight">
          Andrew<span className="text-blue-400">.</span>
        </Link>

        <nav className="hidden md:flex items-center gap-8">
          {links.map((l) => (
            <Link
              key={l.to}
              to={l.to}
              className="text-slate-300 hover:text-white text-sm font-medium transition-colors duration-200"
            >
              {l.label}
            </Link>
          ))}
          <Link
            to="/#contact"
            className="bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors duration-200"
          >
            Hire Me
          </Link>
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
            <Link
              key={l.to}
              to={l.to}
              onClick={() => setOpen(false)}
              className="text-slate-300 hover:text-white text-sm font-medium transition-colors"
            >
              {l.label}
            </Link>
          ))}
          <Link
            to="/#contact"
            onClick={() => setOpen(false)}
            className="bg-blue-600 text-white text-sm font-semibold px-4 py-2 rounded-lg text-center"
          >
            Hire Me
          </Link>
        </div>
      )}
    </header>
  );
}

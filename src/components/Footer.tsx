import { Linkedin, Mail } from 'lucide-react';

export default function Footer() {
  return (
    <footer className="bg-slate-950 py-8 border-t border-slate-800">
      <div className="max-w-6xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div className="text-slate-500 text-sm">
          &copy; {new Date().getFullYear()} Andrew McMorrow. All rights reserved.
        </div>

        <div className="flex items-center gap-4">
          <a
            href="mailto:amcmorrow84@proton.me"
            className="text-slate-500 hover:text-blue-400 transition-colors"
            aria-label="Email"
          >
            <Mail size={18} />
          </a>
          <a
            href="https://www.linkedin.com/in/andrew-mcmorrow/"
            target="_blank"
            rel="noopener noreferrer"
            className="text-slate-500 hover:text-blue-400 transition-colors"
            aria-label="LinkedIn"
          >
            <Linkedin size={18} />
          </a>
        </div>
      </div>
    </footer>
  );
}

import { Mail, Phone, Linkedin, Send } from 'lucide-react';
import FadeIn from './FadeIn';

const contactMethods = [
  {
    icon: Mail,
    label: 'Email',
    value: 'amcmorrow84@proton.me',
    href: 'mailto:amcmorrow84@proton.me',
  },
  {
    icon: Phone,
    label: 'Phone',
    value: '612-384-8959',
    href: 'tel:6123848959',
  },
  {
    icon: Linkedin,
    label: 'LinkedIn',
    value: 'linkedin.com/in/andrew-mcmorrow/',
    href: 'https://www.linkedin.com/in/andrew-mcmorrow/',
  },
];

export default function Contact() {
  return (
    <section id="contact" className="py-24 bg-slate-900 relative overflow-hidden">
      <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_#1e3a5f_0%,_transparent_70%)] pointer-events-none" />

      <div className="relative max-w-5xl mx-auto px-6">
        <FadeIn>
          <div className="text-center mb-14">
            <span className="text-blue-400 text-sm font-semibold uppercase tracking-widest">Contact</span>
            <h2 className="text-4xl font-bold text-white mt-3 mb-4">Let's Work Together</h2>
            <p className="text-slate-400 max-w-lg mx-auto text-lg leading-relaxed">
              Have a project in mind or looking to grow your digital presence? I'd love to hear from you.
            </p>
          </div>
        </FadeIn>

        <div className="grid md:grid-cols-2 gap-10 items-start">
          <div className="flex flex-col gap-5">
            {contactMethods.map(({ icon: Icon, label, value, href }, i) => (
              <FadeIn key={label} delay={i * 90}>
                <a
                  href={href}
                  target={label === 'LinkedIn' ? '_blank' : undefined}
                  rel={label === 'LinkedIn' ? 'noopener noreferrer' : undefined}
                  className="flex items-center gap-5 p-5 rounded-2xl bg-white/5 border border-white/10 hover:bg-white/10 hover:border-white/20 transition-all duration-200 group"
                >
                  <div className="w-12 h-12 rounded-xl bg-blue-600/20 flex items-center justify-center flex-shrink-0 group-hover:bg-blue-600/30 transition-colors">
                    <Icon size={20} className="text-blue-400" />
                  </div>
                  <div>
                    <div className="text-slate-400 text-xs font-medium uppercase tracking-wider mb-0.5">
                      {label}
                    </div>
                    <div className="text-white font-semibold group-hover:text-blue-300 transition-colors">
                      {value}
                    </div>
                  </div>
                </a>
              </FadeIn>
            ))}
          </div>

          <FadeIn delay={150}>
            <form
              onSubmit={(e) => e.preventDefault()}
              className="bg-white/5 border border-white/10 rounded-2xl p-8 flex flex-col gap-5"
            >
              <div className="grid grid-cols-2 gap-4">
                <div className="flex flex-col gap-1.5">
                  <label className="text-slate-400 text-xs font-medium uppercase tracking-wider">
                    First Name
                  </label>
                  <input
                    type="text"
                    placeholder="Jane"
                    className="bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-600 text-sm focus:outline-none focus:border-blue-500 transition-colors"
                  />
                </div>
                <div className="flex flex-col gap-1.5">
                  <label className="text-slate-400 text-xs font-medium uppercase tracking-wider">
                    Last Name
                  </label>
                  <input
                    type="text"
                    placeholder="Smith"
                    className="bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-600 text-sm focus:outline-none focus:border-blue-500 transition-colors"
                  />
                </div>
              </div>

              <div className="flex flex-col gap-1.5">
                <label className="text-slate-400 text-xs font-medium uppercase tracking-wider">
                  Email
                </label>
                <input
                  type="email"
                  placeholder="jane@company.com"
                  className="bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-600 text-sm focus:outline-none focus:border-blue-500 transition-colors"
                />
              </div>

              <div className="flex flex-col gap-1.5">
                <label className="text-slate-400 text-xs font-medium uppercase tracking-wider">
                  Message
                </label>
                <textarea
                  rows={4}
                  placeholder="Tell me about your project..."
                  className="bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-600 text-sm focus:outline-none focus:border-blue-500 transition-colors resize-none"
                />
              </div>

              <a
                href="mailto:amcmorrow1@gmail.com"
                className="flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-500 active:scale-[0.97] hover:scale-[1.02] text-white font-semibold py-3.5 rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-blue-600/25"
              >
                <Send size={16} />
                Send Message
              </a>
            </form>
          </FadeIn>
        </div>
      </div>
    </section>
  );
}

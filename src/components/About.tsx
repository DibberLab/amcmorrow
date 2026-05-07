import { TrendingUp, LayoutGrid as Layout, Search, ShoppingCart, Mail, Database } from 'lucide-react';
import FadeIn from './FadeIn';

const skills = [
  { icon: TrendingUp, label: 'Digital Marketing & Strategy' },
  { icon: ShoppingCart, label: 'E-commerce Optimization' },
  { icon: Layout, label: 'UX & Web Design' },
  { icon: Search, label: 'SEO' },
  { icon: Mail, label: 'Email Marketing' },
  { icon: Database, label: 'ERP & Database Management' },
];

const stats = [
  { value: '10+', label: 'Years Experience' },
  { value: '8+', label: 'Brands Elevated' },
  { value: '5+', label: 'Client Projects' },
];

export default function About() {
  return (
    <section id="about" className="py-24 bg-white">
      <div className="max-w-6xl mx-auto px-6">
        <div className="grid md:grid-cols-2 gap-16 items-center">
          <FadeIn>
            <div>
              <span className="text-blue-600 text-sm font-semibold uppercase tracking-widest">About Me</span>
              <h2 className="text-4xl font-bold text-slate-900 mt-3 mb-6 leading-tight">
                Turning digital strategy into measurable growth
              </h2>
              <p className="text-slate-600 text-lg leading-relaxed mb-6">
                With over a decade in digital marketing and e-commerce, I specialize in building
                cohesive strategies that span UX design, SEO, email marketing, and paid campaigns.
                I've helped brands across outdoor recreation, jewelry, gaming, and services industries
                connect with their audiences and scale their online presence.
              </p>
              <p className="text-slate-600 text-lg leading-relaxed mb-8">
                My approach is data-driven and cross-functional — I bridge creative vision with
                analytical thinking to deliver results that matter: more traffic, better conversions,
                and stronger brands.
              </p>

              <div className="grid grid-cols-3 gap-6">
                {stats.map((s, i) => (
                  <FadeIn key={s.label} delay={i * 100}>
                    <div className="text-center p-4 bg-slate-50 rounded-xl">
                      <div className="text-3xl font-bold text-blue-600 mb-1">{s.value}</div>
                      <div className="text-slate-500 text-sm font-medium">{s.label}</div>
                    </div>
                  </FadeIn>
                ))}
              </div>
            </div>
          </FadeIn>

          <FadeIn delay={180}>
            <div>
              <h3 className="text-sm font-semibold uppercase tracking-widest text-slate-400 mb-6">
                Core Competencies
              </h3>
              <div className="grid grid-cols-2 gap-4">
                {skills.map(({ icon: Icon, label }, i) => (
                  <FadeIn key={label} delay={i * 60}>
                    <div className="flex items-center gap-3 p-4 rounded-xl border border-slate-100 hover:border-blue-100 hover:bg-blue-50/50 transition-all duration-200 group">
                      <div className="w-9 h-9 rounded-lg bg-blue-600/10 flex items-center justify-center flex-shrink-0 group-hover:bg-blue-600/20 transition-colors">
                        <Icon size={18} className="text-blue-600" />
                      </div>
                      <span className="text-slate-700 text-sm font-medium leading-snug">{label}</span>
                    </div>
                  </FadeIn>
                ))}
              </div>

              <div className="mt-6 p-4 rounded-xl bg-slate-50 border border-slate-100">
                <p className="text-slate-500 text-sm leading-relaxed">
                  <span className="font-semibold text-slate-700">Additional skills:</span> Brand Development,
                  Video Graphics, ERP Systems, WordPress, Shopify, and more.
                </p>
              </div>
            </div>
          </FadeIn>
        </div>
      </div>
    </section>
  );
}

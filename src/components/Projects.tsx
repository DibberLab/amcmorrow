import { ExternalLink } from 'lucide-react';

const projects = [
  {
    name: 'Epic Ebike Adventures',
    platform: 'Shopify',
    description:
      'A full-featured Shopify store for an e-bike rental and tour business, complete with booking functionality, product showcase, and optimized user flows for conversions.',
    image: 'https://images.pexels.com/photos/1149601/pexels-photo-1149601.jpeg?auto=compress&cs=tinysrgb&w=800',
    tags: ['Shopify', 'E-commerce', 'UX Design'],
  },
{
    name: 'Raney Family Scholarship',
    platform: 'Static HTML / CSS',
    description:
      'A welcoming, nature-inspired landing page for a Vermont-based camp scholarship, designed to streamline the application process and provide clear accessibility information for families.',
    image: 'https://images.pexels.com/photos/1761279/pexels-photo-1761279.jpeg?auto=compress&cs=tinysrgb&w=800',
    tags: ['Web Development', 'Non-Profit', 'UI Design'],
  },
  {
    name: 'Brisk Services',
    platform: 'WordPress',
    description:
      'A clean, professional WordPress site for a local services company, built with lead generation in mind — fast loading, mobile-first, and SEO-optimized.',
    image: 'https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=800',
    tags: ['WordPress', 'SEO', 'Web Design'],
  },
  {
    name: 'Driftless Camp',
    platform: 'WordPress',
    description:
      'A WordPress site for a camping destination in the Driftless region, featuring event listings, booking integrations, and rich visual storytelling through photography.',
    image: 'https://images.pexels.com/photos/1687845/pexels-photo-1687845.jpeg?auto=compress&cs=tinysrgb&w=800',
    tags: ['WordPress', 'Brand Design', 'Content'],
  },
  {
    name: 'Bellflower Bodywork',
    platform: 'WordPress',
    description:
      'A serene, welcoming website for a massage therapy practice, with online booking integration, service descriptions, and a calm aesthetic that reflects the brand.',
    image: 'https://images.pexels.com/photos/3757942/pexels-photo-3757942.jpeg?auto=compress&cs=tinysrgb&w=800',
    tags: ['WordPress', 'Brand Development', 'UX Design'],
  },
  {
    name: 'Focused Fire',
    platform: 'WordPress',
    description:
      'An e-commerce-enabled WordPress site for a laser engraving business, showcasing custom product capabilities and driving inquiries through clear calls to action.',
    image: 'https://images.pexels.com/photos/4491461/pexels-photo-4491461.jpeg?auto=compress&cs=tinysrgb&w=800',
    tags: ['WordPress', 'E-commerce', 'Brand Design'],
  },
];

export default function Projects() {
  return (
    <section id="projects" className="py-24 bg-white">
      <div className="max-w-6xl mx-auto px-6">
        <div className="text-center mb-14">
          <span className="text-blue-600 text-sm font-semibold uppercase tracking-widest">Portfolio</span>
          <h2 className="text-4xl font-bold text-slate-900 mt-3">Client Projects</h2>
          <p className="text-slate-500 mt-3 max-w-xl mx-auto">
            A selection of websites and digital experiences built for clients across a variety of industries.
          </p>
        </div>

        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-7">
          {projects.map((project) => (
            <div
              key={project.name}
              className="group rounded-2xl border border-slate-100 overflow-hidden hover:border-blue-200 hover:shadow-xl hover:shadow-blue-50 hover:-translate-y-1 transition-all duration-300 bg-white flex flex-col"
            >
              <div className="relative overflow-hidden aspect-video">
                <img
                  src={project.image}
                  alt={project.name}
                  className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent" />
                <div className="absolute bottom-3 left-4">
                  <span className="text-xs font-semibold text-white/80 bg-white/20 backdrop-blur-sm px-2.5 py-1 rounded-full border border-white/20">
                    {project.platform}
                  </span>
                </div>
              </div>

              <div className="p-6 flex-1 flex flex-col">
                <h3 className="text-slate-900 font-bold text-lg mb-2 group-hover:text-blue-600 transition-colors">
                  {project.name}
                </h3>
                <p className="text-slate-500 text-sm leading-relaxed mb-5 flex-1">{project.description}</p>
                <div className="flex flex-wrap gap-2">
                  {project.tags.map((tag) => (
                    <span
                      key={tag}
                      className="text-xs font-medium bg-slate-50 text-slate-600 border border-slate-100 px-2.5 py-1 rounded-lg"
                    >
                      {tag}
                    </span>
                  ))}
                </div>
              </div>
            </div>
          ))}

          <div className="md:col-span-2 lg:col-span-1 rounded-2xl border-2 border-dashed border-slate-200 p-8 flex flex-col items-center justify-center text-center hover:border-blue-300 hover:bg-blue-50/30 transition-all duration-200 group">
            <div className="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center mb-4 group-hover:bg-blue-100 transition-colors">
              <ExternalLink size={20} className="text-blue-500" />
            </div>
            <h3 className="text-slate-700 font-semibold mb-2">More on Request</h3>
            <p className="text-slate-400 text-sm leading-relaxed">
              Additional projects and case studies available. Reach out to learn more.
            </p>
          </div>
        </div>
      </div>
    </section>
  );
}

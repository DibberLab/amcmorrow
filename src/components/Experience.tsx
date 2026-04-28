const jobs = [
  {
    company: 'Revo Brands',
    url: 'https://revobrands.com',
    role: 'Web & UX Design',
    tags: ['Web Design', 'UX Design'],
    description:
      'Led web and UX design initiatives to enhance user experience across digital properties, improving engagement and conversion rates.',
  },
  {
    company: 'Real Avid',
    url: 'https://realavid.com',
    role: 'SEO, UX & Email Marketing',
    tags: ['SEO', 'UX Design', 'Email Marketing'],
    description:
      'Drove organic growth through technical SEO improvements and UX refinements. Managed email marketing campaigns that expanded customer retention.',
  },
  {
    company: 'Outdoor Edge',
    url: 'https://outdooredge.com',
    role: 'UX Design & Digital Marketing',
    tags: ['UX Design', 'SEO', 'Email Marketing'],
    description:
      'Optimized digital storefronts and implemented data-driven email campaigns to increase online revenue for this outdoor gear brand.',
  },
  {
    company: 'WorkIQ Tools',
    url: 'https://workiqtools.com',
    role: 'Brand & Web Strategy',
    tags: ['Brand Development', 'Web Design', 'SEO', 'Email Marketing'],
    description:
      'Built the brand identity from the ground up, including full website design, SEO strategy, and automated email marketing flows.',
  },
  {
    company: 'Dakota Stones',
    url: 'https://dakotastones.com',
    role: 'E-commerce & ERP',
    tags: ['ERP', 'Web Development', 'Email Marketing'],
    description:
      'Oversaw ERP integration with the e-commerce platform, streamlining inventory management and improving fulfillment efficiency.',
  },
  {
    company: 'Goody Beads',
    url: 'https://goodybeads.com',
    role: 'Database & Web Design',
    tags: ['Database Management', 'Web Design', 'Email Marketing'],
    description:
      'Managed product database architecture and redesigned the e-commerce site, resulting in a significantly improved shopping experience.',
  },
  {
    company: 'Treasure Island Casino',
    url: 'https://ticasino.com',
    role: 'Email & Digital Marketing',
    tags: ['Email Marketing', 'Video Graphics', 'SEO'],
    description:
      'Produced video marketing assets and executed multi-channel digital campaigns that drove event attendance and customer engagement.',
  },
  {
    company: 'Ainsley Shea',
    url: 'https://ainsleyshea.com',
    role: 'Web & Brand Design',
    tags: ['Web Design', 'Brand Development'],
    description:
      'Developed a complete brand identity and professional website to establish a compelling online presence for this boutique firm.',
  },
];

const tagColors: Record<string, string> = {
  'Web Design': 'bg-blue-50 text-blue-700 border-blue-100',
  'UX Design': 'bg-sky-50 text-sky-700 border-sky-100',
  SEO: 'bg-teal-50 text-teal-700 border-teal-100',
  'Email Marketing': 'bg-green-50 text-green-700 border-green-100',
  'Brand Development': 'bg-amber-50 text-amber-700 border-amber-100',
  ERP: 'bg-orange-50 text-orange-700 border-orange-100',
  'Database Management': 'bg-red-50 text-red-700 border-red-100',
  'Web Development': 'bg-cyan-50 text-cyan-700 border-cyan-100',
  'Video Graphics': 'bg-rose-50 text-rose-700 border-rose-100',
};

export default function Experience() {
  return (
    <section id="experience" className="py-24 bg-slate-50">
      <div className="max-w-6xl mx-auto px-6">
        <div className="text-center mb-14">
          <span className="text-blue-600 text-sm font-semibold uppercase tracking-widest">Career</span>
          <h2 className="text-4xl font-bold text-slate-900 mt-3">Full-Time Experience</h2>
          <p className="text-slate-500 mt-3 max-w-xl mx-auto">
            A track record of delivering digital growth across diverse industries.
          </p>
        </div>

        <div className="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
          {jobs.map((job) => (
            <div
              key={job.company}
              className="bg-white rounded-2xl border border-slate-100 p-6 hover:border-blue-200 hover:shadow-lg hover:shadow-blue-50 hover:-translate-y-1 transition-all duration-300 flex flex-col"
            >
              <div className="flex-1">
  <h3 className="text-slate-900 font-bold text-lg mb-1">
    {/* Wrap the company name in a link */}
    <a 
      href={job.url} 
      target="_blank" 
      rel="noopener noreferrer"
      className="hover:text-blue-600 transition-colors duration-200"
    >
      {job.company}
    </a>
  </h3>
                <p className="text-blue-600 text-sm font-medium mb-4">{job.role}</p>
                <p className="text-slate-500 text-sm leading-relaxed mb-5">{job.description}</p>
              </div>
              <div className="flex flex-wrap gap-2 mt-auto">
                {job.tags.map((tag) => (
                  <span
                    key={tag}
                    className={`text-xs font-medium px-2.5 py-1 rounded-lg border ${
                      tagColors[tag] ?? 'bg-slate-50 text-slate-600 border-slate-100'
                    }`}
                  >
                    {tag}
                  </span>
                ))}
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}

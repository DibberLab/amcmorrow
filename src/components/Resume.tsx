import { FileText, FileType, File } from 'lucide-react';
import Nav from './Nav';
import Footer from './Footer';

export default function Resume() {
  return (
    <div className="min-h-screen flex flex-col bg-slate-50">
      <Nav />

      <main className="flex-1 pt-28 pb-24">
        <div className="max-w-4xl mx-auto px-6">

          {/* Download bar */}
          <div className="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
              <span className="text-blue-600 text-sm font-semibold uppercase tracking-widest">Career</span>
              <h1 className="text-4xl font-bold text-slate-900 mt-1">Resume</h1>
            </div>
            <div className="flex gap-3">
              <a
                href="/docs/Andrew McMorrow.pdf"
                download
                className="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors"
              >
                <FileText size={15} /> PDF
              </a>
              <a
                href="/docs/Andrew McMorrow.docx"
                download
                className="inline-flex items-center gap-2 bg-white hover:bg-slate-50 text-slate-700 text-sm font-semibold px-4 py-2 rounded-lg border border-slate-200 transition-colors"
              >
                <File size={15} /> DOC
              </a>
              <a
                href="/docs/Andrew McMorrow.txt"
                download
                className="inline-flex items-center gap-2 bg-white hover:bg-slate-50 text-slate-700 text-sm font-semibold px-4 py-2 rounded-lg border border-slate-200 transition-colors"
              >
                <FileType size={15} /> TXT
              </a>
            </div>
          </div>

          <div className="bg-white rounded-2xl border border-slate-100 shadow-sm p-8 sm:p-12 space-y-10">

            {/* Header */}
            <div>
              <h2 className="text-3xl font-bold text-slate-900">Andrew McMorrow</h2>
              <p className="text-slate-500 mt-2 text-sm">
                Minneapolis, MN &nbsp;&middot;&nbsp;
                <a href="mailto:amcmorrow84@proton.me" className="text-blue-600 hover:underline">amcmorrow84@proton.me</a>
                &nbsp;&middot;&nbsp;
                <a href="tel:+16123848959" className="text-blue-600 hover:underline">612-384-8959</a>
                &nbsp;&middot;&nbsp;
                <a href="https://amcmorrow.com" target="_blank" rel="noopener noreferrer" className="text-blue-600 hover:underline">amcmorrow.com</a>
              </p>
            </div>

            {/* Professional Summary */}
            <section>
              <h3 className="text-lg font-bold text-blue-600 border-b border-slate-100 pb-2 mb-4 uppercase tracking-wide text-sm">
                Professional Summary
              </h3>
              <p className="text-slate-600 leading-relaxed">
                A results-driven ecommerce leader with over 10 years of experience architecting D2C strategy and executing technical solutions that drive measurable revenue growth. Proven expertise in optimizing the entire digital ecosystem, from complex website migrations and marketing automation to data analysis and user experience. Adept at leading cross-functional teams and leveraging data-driven insights to surpass ambitious business goals.
              </p>
            </section>

            {/* Core Competencies */}
            <section>
              <h3 className="text-lg font-bold text-blue-600 border-b border-slate-100 pb-2 mb-4 uppercase tracking-wide text-sm">
                Core Competencies
              </h3>
              <div className="space-y-3">
                <div>
                  <span className="font-semibold text-slate-800">Ecommerce & Strategy: </span>
                  <span className="text-slate-600">D2C Strategy & Execution, Ecommerce Optimization, Website Migration, UX/UI Design & Accessibility, Workflow Automation</span>
                </div>
                <div>
                  <span className="font-semibold text-slate-800">Marketing & Analytics: </span>
                  <span className="text-slate-600">Email Marketing & Automation, Performance Analytics, SEO/SEM/PPC Campaigns, A/B Testing, Conversion Rate Optimization, Content Marketing</span>
                </div>
                <div>
                  <span className="font-semibold text-slate-800">Technical Proficiencies: </span>
                  <span className="text-slate-600">Shopify, Klaviyo, Google Analytics, Looker, HTML, CSS, JavaScript, SQL, Bright Pearl, Meta Ads, AI Models (ChatGPT, Claude, Gemini APIs)</span>
                </div>
              </div>
            </section>

            {/* Professional Experience */}
            <section>
              <h3 className="text-lg font-bold text-blue-600 border-b border-slate-100 pb-2 mb-6 uppercase tracking-wide text-sm">
                Professional Experience
              </h3>
              <div className="space-y-8">

                <div>
                  <div className="flex flex-col sm:flex-row sm:items-baseline sm:justify-between gap-1 mb-1">
                    <h4 className="text-slate-900 font-bold text-lg">Revo Brands <span className="font-normal text-slate-500 text-base">— Maple Grove, MN</span></h4>
                    <span className="text-slate-400 text-sm whitespace-nowrap">Oct 2021 – Present</span>
                  </div>
                  <p className="text-blue-600 text-sm font-medium mb-2">Senior Ecommerce & Digital Strategy Manager</p>
                  <p className="text-slate-500 text-sm italic mb-3">Directed the comprehensive digital strategy for D2C and B2B ecommerce channels, leading a cross-functional team to enhance digital presence, optimize user experience, and drive revenue growth through data-driven initiatives.</p>
                  <ul className="list-disc list-outside pl-5 space-y-1.5 text-slate-600 text-sm">
                    <li>Spearheaded ecommerce strategies across three brands, optimizing websites and wholesale dealer portals to achieve a <strong>20% increase</strong> in online sales revenue.</li>
                    <li>Led the D2C strategy, overseeing website content, product merchandising, and promotional campaigns on Shopify to drive sales and enhance customer loyalty.</li>
                    <li>Implemented Klaviyo for automated email marketing, developing welcome, abandoned cart, and winback flows that improved engagement and resulted in a <strong>25% increase</strong> in email-driven revenue.</li>
                    <li>Conducted in-depth data analysis on sales, customer behavior, and site traffic, generating actionable insights that drove a <strong>15% improvement</strong> in conversion rates.</li>
                    <li>Orchestrated the multi-brand digital marketing calendar for product launches and campaigns, using ClickUp to streamline collaboration with creative and brand leadership.</li>
                    <li>Enhanced product discoverability by <strong>30%</strong> by designing and optimizing product listings and keywords.</li>
                    <li>Led accessibility compliance efforts to ensure all digital platforms met WCAG standards, enhancing inclusivity.</li>
                  </ul>
                </div>

                <div>
                  <div className="flex flex-col sm:flex-row sm:items-baseline sm:justify-between gap-1 mb-1">
                    <h4 className="text-slate-900 font-bold text-lg">Dakota Stones <span className="font-normal text-slate-500 text-base">— Edina, MN</span></h4>
                    <span className="text-slate-400 text-sm whitespace-nowrap">April 2007 – Oct 2021</span>
                  </div>
                  <p className="text-blue-600 text-sm font-medium mb-2">Director of Ecommerce & Technology</p>
                  <p className="text-slate-500 text-sm italic mb-3">Served as the lead data strategist and technical director, culminating in a leadership position overseeing all ecommerce operations, digital marketing, and IT infrastructure for multiple brand websites.</p>
                  <ul className="list-disc list-outside pl-5 space-y-1.5 text-slate-600 text-sm">
                    <li>Directed a complex, dual-system migration of ERP from Intuit POS to Bright Pearl and the company website to Shopify, ensuring <strong>100% data accuracy</strong> during the transition.</li>
                    <li>Successfully re-platformed Dakotastones.com to Shopify, which boosted online sales by <strong>18%</strong> through improved site responsiveness and usability.</li>
                    <li>Increased operational efficiency by <strong>20%</strong> by managing and optimizing physical inventory processes and streamlining product listings.</li>
                    <li>Engineered custom HTML, CSS, and JavaScript features to enhance Shopify theme functionality and user experience.</li>
                    <li>Grew website traffic by <strong>15%</strong> by creating and executing weekly email campaigns and blog content.</li>
                  </ul>
                </div>

                <div>
                  <div className="flex flex-col sm:flex-row sm:items-baseline sm:justify-between gap-1 mb-1">
                    <h4 className="text-slate-900 font-bold text-lg">Treasure Island Casino <span className="font-normal text-slate-500 text-base">— Welch, MN</span></h4>
                    <span className="text-slate-400 text-sm whitespace-nowrap">July 2015 – June 2018</span>
                  </div>
                  <p className="text-blue-600 text-sm font-medium mb-2">Digital Marketing Strategist</p>
                  <p className="text-slate-500 text-sm italic mb-3">Developed and executed integrated digital marketing strategies for a premier resort and casino, managing the online presence for the main casino and its associated brands, including a golf course and community website.</p>
                  <ul className="list-disc list-outside pl-5 space-y-1.5 text-slate-600 text-sm">
                    <li>Designed and launched TICasino.com, incorporating SEO best practices that resulted in a <strong>40% increase</strong> in organic traffic.</li>
                    <li>Managed multi-channel digital marketing campaigns (SEM, PPC, display ads), achieving a <strong>25% growth</strong> in customer acquisition.</li>
                    <li>Increased video engagement rates on social media by <strong>30%</strong> through strategic content editing and campaign deployment.</li>
                    <li>Developed and coded the Mount Frontenac Golf Course website to improve site usability and user satisfaction.</li>
                  </ul>
                </div>

              </div>
            </section>

            {/* Education */}
            <section>
              <h3 className="text-lg font-bold text-blue-600 border-b border-slate-100 pb-2 mb-4 uppercase tracking-wide text-sm">
                Education
              </h3>
              <div className="flex flex-col sm:flex-row sm:items-baseline sm:justify-between gap-1 mb-1">
                <h4 className="text-slate-900 font-bold text-lg">Brown College <span className="font-normal text-slate-500 text-base">— Mendota Heights, MN</span></h4>
                <span className="text-slate-400 text-sm whitespace-nowrap">April 2006</span>
              </div>
              <p className="text-slate-700 font-medium text-sm mb-2">Associate of Arts in Visual Communications with Emphasis on Multi-Media</p>
              <ul className="list-disc list-outside pl-5 text-slate-600 text-sm">
                <li>Relevant Coursework: Ecommerce Fundamentals, Digital Marketing, Email Marketing Automation, and Conversion Optimization.</li>
              </ul>
            </section>

          </div>
        </div>
      </main>

      <Footer />
    </div>
  );
}

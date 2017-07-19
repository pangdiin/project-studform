<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;
use App\Models\Project\Project;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProjectTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('projects');


        $faker = Faker::create();
        $mayfair = Project::create([
        	'name' => 'Mayfair Hotel, Adelaide, SA',
        	'description' => 'Schiavello approached Studform to design the perfect door solution for their heritage hotel.',
        	'content' => '
        		<p>Schiavello approached Studform to design the perfect door solution for their heritage hotel.</p>
				<p>The doors had to look great for guests, match the existing look of the hotel and provide acoustically sound doors for a Heritage-listed Hotel.</p>
				<h4>Project Details</h4>
				<p style="clear: both;"><strong>Building:</strong> Heritage Listed Hotel<br> <strong>Address:</strong> Corner of King William &amp; Hindley St, Adelaide<br> <strong>Brief:</strong> Deliver the perfect door solution for a heritage building</p>
				<h5>Challenges</h5>
				<p>The Mayfair hotel wanted the design boundaries pushed, avoiding the standard flush panel fire doors of other hotels.</p>
				<h5>Design</h5>
				<p>Studform was included in the design stage to assist with the specification. Being an existing building, floor heights varied from room to room and presented new challenges. Prototyping of decorative design worked to ensure consistency of design and height throughout the building, and acoustic testing of the design addressed the client’s needs.</p>
				<h5>Solution</h5>
				<p>The design result was a routered pattern-faced door and acoustically rated. Sonus tested the doors to ensure they met the required RW/STC ratings.</p>
				<p>Following an early test on our interconnecting doors we didn’t reach the required acoustic performance. The challenge was to improve its performance in this location which we achieved in the next schedule test by Sonus.</p>
				<h5>Client Feedback</h5>
				<p><em>“A sharp, solid and ‘Acoustically Sound’ bedroom door: Perfect”</em> - P Vukajlovic, Senior Project Manager</p>
				<p>To learn more about the Mayfair Hotel project and view the amazing architecture, click here to read about it in <a href="http://issuu.com/crowtherblaynemediaspecialists/docs/sa_mb_aprmay15_ebook?e=12823049/30736200" target="_blank">SA Builder Magazine (pages 55-58)</a>.</p>
				<p>For more information on our range of Acoustic Doors, contact Studform for more information on <strong>1800 352 366</strong>.</p>
        	',
        	'image' => 'img/default/project/mayfair-hotel.jpg'

        ]);

        $mayfairData = collect([
            ['path'  =>  'img/default/gallery/project/mayfair/mayfair1.jpg'],
            ['path'  =>  'img/default/gallery/project/mayfair/mayfair2.jpg'],
            ['path'  =>  'img/default/gallery/project/mayfair/mayfair3.jpg'],
            ['path'  =>  'img/default/gallery/project/mayfair/mayfair4.jpg'],
        ]);

        gallerySeeder($mayfair, $mayfairData);

        $royalHospital = Project::create([
        	'name' => 'New Royal Adelaide Hospital',
        	'description' => 'The Kwikloc Seismic ceiling system brings to the industry new levels of seismic ceiling performance.',
        	'content' => '
        		<p>The engineers for the NRAH wanted an easy to install ceiling system that would meet stringent seismic and health requirements plus provide extensive accessibility as is the case with grid and tile systems. By eliminating the typical extent of bracing required for other systems hence maximising the ceiling void space for the multitude of services found in hospital ceilings. Furthermore, providing characteristics that meet the stringent health requirements of this landmark facility, the Kwikloc Seismic Ceiling System provided the ultimate solutions. The system&rsquo;s unique ability offers both Seismic movement and resists loads at the highest benchmarks as well as offer high hygiene function through the maintenance of a flat even plane ensuring accurate and precise grid to tile interfacing.</p>
					<p><strong>Seismic Requirements</strong></p>
					<p>The Kwikloc aluminium Seismic ceiling grid systems have the structural capacity to meet and exceed the loading requirements of both AS1170.4 and NZS 4203 with respect to the horizontal and vertical earthquake forces. Specific design requirement standards for the Kwikloc System are available for the various areas and activity levels throughout Australia and New Zealand.&nbsp;</p>
					<p><strong>Performance Levels</strong></p>
					<p>The Kwikloc Seismic ceiling system brings to the industry new levels of seismic ceiling performance, having sustained up to 3G tested forces with 100% vertical uplift. This represents 25-30% increased performance when compared to other ceiling systems available on the market today. A representative of the testing facility in New York State, USA commented, “this system was tested to the limits of our equipment.” The Engineering Reporter/Photographer also commented, “this is a very good system. Best we’ve seen. Normally systems fail at 2.0 to 2.25” (note that standard testing requirements include 67% vertical uplift).</p>
					<p><strong>Solution</strong></p>
					<p>The system has unique advantages in ultimate seismic ceiling design. The wall bracket system facilitates fixing one side and floating on the opposite side of both plane directions in a ceiling installation, as required by Engineers. The use of a patented two-part wall angle system and sliding bracket assembly, provides the unique feature of maintaining a flat, even plane for accurate tile nesting throughout the entire installation. This is particularly important in health projects, e.g. hospitals, medic centres and laboratories, where hygiene standards are of high importance.&nbsp;</p>
					<p>Kwikloc has been used on many other seismic focused projects since the success of the NRAH and has proven to save thousands in labour costs due to the minimal bracing requirements in comparison to other systems on the market.&nbsp;</p>
					<p style="text-align: center;"><em>“This ceiling was tested to the limits of our equipment.” - Engineer</em></p>
        	',
        	'image' => 'img/default/project/new-royal-adelaide-hospital.jpg'

        ]);

        $royalHospitalData = collect([
            ['path'  =>  'img/default/gallery/project/royal/royal1.jpg'],
            ['path'  =>  'img/default/gallery/project/royal/royal2.jpg'],
            ['path'  =>  'img/default/gallery/project/royal/royal3.jpg'],
            ['path'  =>  'img/default/gallery/project/royal/royal4.jpg'],
        ]);

        gallerySeeder($royalHospital, $royalHospitalData);


        $central = Project::create([
        	'name' => 'City Central - Tower 8, 12-26 Franklin Street, Adelaide, SA',
        	'description' => 'Designers of Adelaide’s new Tower 8 development selected Korporate aluminium partitions, Acoulite doors & Imaj toilet cubicles for this high profile project in Adelaide CBD.',
        	'content' => '
        		<p>Construction is now completed on the $160m Tower 8 Project - the third office building constructed by Baulderstone in the evolving City Centre Precinct in Adelaide&rsquo;s central business district. The 17-level, 36,500 square metre commercial development, which faces Franklin Street, will provide office space for the Australian Tax Office and other tenants, associated car parking, ground level retail, and Australia Post operations, including mail distribution and post office boxes.</p>
					<p>With this building being&nbsp;a showpiece in a&nbsp;series of master planned developments, architects and builders were taking no shortcuts on quality and premium finishes when it came to selecting an&nbsp;&nbsp;aluminium partition suite, acoustic doors and&nbsp;the washroom partition system.</p>
					<h4>More on this building…</h4>
					<p>Tower 8 will be located on the North Eastern corner of Franklin and Bentham Streets and acts as a southern gateway to the City Central Precinct. With visibility from Victoria Square and Franklin Street, this building will be a landmark in the CBD.</p>
					<p>Tower 8 is the next &rsquo;State of the Art&rsquo; office building in the City Central Precinct Redevelopment. Tower 8 will continue the benchmark standards set in ANZ House on Waymouth street and the Ernst and Young Building on King William Street.</p>
					<p>The&nbsp;iconic office tower was completed&nbsp;in September 2012.</p>
					<ul>
					<li>Floorplates up to 2,180sq m</li>
					<li>Australian Best Practice Sustainable Design</li>
					<li>Over 280 Car Parking Spaces On-Site</li>
					<li>Part of the Exciting New City Central Precinct</li>
					</ul>
        	',
        	'image' => 'img/default/project/city-central.jpg'

        ]);

        $centralData = collect([
            ['path'  =>  'img/default/gallery/project/central/central1.jpg'],
            ['path'  =>  'img/default/gallery/project/central/central2.jpg'],
            ['path'  =>  'img/default/gallery/project/central/central3.jpg'],
            ['path'  =>  'img/default/gallery/project/central/central4.jpg'],
            ['path'  =>  'img/default/gallery/project/central/central5.jpg'],
        ]);

        gallerySeeder($central, $centralData);

         $warrnambool =  Project::create([
        	'name' => 'South West Healthcare&rsquo;s Warrnambool hospital',
        	'description' => 'Studform a major supplier to South West Healthcare&rsquo;s Warrnambool hospital project with 16km of Korpline skirtingsw.',
        	'content' => '
        		<div class="std"><h3>Opened to patients in March  2011,  South West Healthcare&rsquo;s Warrnambool hospital redevelopment is a unique and modern development which called for careful use of fitout materials throughout to achieve the design specifications</h3>
				<p>Capital Redevelopment Manager for South West Healthcare Wayne Hall worked with Studform to ensure the highest quality materials and finishes were applied to the project, especially in the critical areas of  Hygiene and ESD (Environmentally Sustainable Design).</p>
				<p>There has been a lot of focus on the design which is a cutting edge design for the Health sector -  which seeks to minimise the hospital feel - Indeed the foyer appears more like a shopping mall, and much of the medical equipment usually seen in wards is concealed in the new hospital, giving it more of a hotel feel.</p>
				<p>A nautical theme has also been employed in some parts and is reflected in details such as portholes at nursing stations and a courtyard which will include a structure meant to resemble a sunken shipwreck.</p>
				<p>It&rsquo;s certainly a sharp contrast to the 1960s hospital building joined to the new development, although the long term plan is to redevelop the old building so it matches the new one, giving it a similar exterior and ultimately refitting it over the next five or six years.</p>
				<div class="gallery-main">
				<p><a class="product-link" title="Studform a major supplier to South West Healthcare&rsquo;s Warrnambool hospital project" rel="prettyPhoto[gallery2]" href="http://www.studform.com.au/media/wysiwyg/Base/w_hosp/1.jpg">Click here to view the Image Gallery </a><a class="product-link" style="display: none;" title="Studform a major supplier to South West Healthcare&rsquo;s Warrnambool hospital project" rel="prettyPhoto[gallery2]" href="http://www.studform.com.au/media/wysiwyg/Base/w_hosp/2.jpg"> 2 </a> <a class="product-link" style="display: none;" title="Studform a major supplier to South West Healthcare&rsquo;s Warrnambool hospital project" rel="prettyPhoto[gallery2]" href="http://www.studform.com.au/media/wysiwyg/Base/w_hosp/3.jpg"> 3 </a> <a class="product-link" style="display: none;" title="Studform a major supplier to South West Healthcare&rsquo;s Warrnambool hospital project" rel="prettyPhoto[gallery2]" href="http://www.studform.com.au/media/wysiwyg/Base/w_hosp/4.jpg"> 4 </a> <a class="product-link" style="display: none;" title="Studform a major supplier to South West Healthcare&rsquo;s Warrnambool hospital project" rel="prettyPhoto[gallery2]" href="http://www.studform.com.au/media/wysiwyg/Base/w_hosp/5.jpg"> 5 </a></p>
				</div>
        	',
        	'image' => 'img/default/project/warrnambool-hospital.jpg'

        ]);


        $warrnamboolData = collect([
            ['path'  =>  'img/default/gallery/project/war/war1.jpg'],
            ['path'  =>  'img/default/gallery/project/war/war2.jpg'],
            ['path'  =>  'img/default/gallery/project/war/war3.jpg'],
            ['path'  =>  'img/default/gallery/project/war/war4.jpg'],
            ['path'  =>  'img/default/gallery/project/war/war5.jpg'],
        ]);

        gallerySeeder($warrnambool, $warrnamboolData);

       $goldCoast = Project::create([
        	'name' => 'Gold Coast Hospital',
        	'description' => 'Studform Aluminium skirting a part of $1.76 billion Gold Coast University Hospital.',
        	'content' => '
        		<h3>In 2012, Gold Coast Hospital will be absorbed into a new 750 bed tertiary facility to create the Gold Coast University Hospital. The $1.76 billion health facility will provide complex care, research and teaching opportunities on the Gold Coast and will play a key role in training the clinical leaders of the future.</h3>
				<p>Studform have been involved with the project as a supplier of the Korporate Alumium skirting system, which offered a unique finish, and installation advantages to the builder.</p>
				<p>Korporate Aluminium skirting provides modern edging styles for joints formed by walls and floor, no matter what wall and floor materials have been used.</p>
				<div class="gallery-main">
				<p><a class="product-link" title="Studform Aluminium skirting a part of $1.76 billion  Gold Coast University Hospital" rel="prettyPhoto[gallery2]" href="http://www.studform.com.au/media/wysiwyg/Base/gc_hosp/gc_hosp1.jpg">Click here to view the Image Gallery </a> <a class="product-link" style="display: none;" title="Studform Aluminium skirting a part of $1.76 billion  Gold Coast University Hospital" rel="prettyPhoto[gallery2]" href="http://www.studform.com.au/media/wysiwyg/Base/gc_hosp/gc_hosp2.jpg"> 2 </a><a class="product-link" style="display: none;" title="Studform Aluminium skirting a part of $1.76 billion  Gold Coast University Hospital" rel="prettyPhoto[gallery2]" href="http://www.studform.com.au/media/wysiwyg/Base/gc_hosp/gc_hosp5.jpg"> 5 </a></p>
				</div>
        	',
        	'image' => 'img/default/project/gold-coast-university-hospital.jpg'

        ]);

       $goldCoastData = collect([
            ['path'  =>  'img/default/gallery/project/gold/gc_hosp1.jpg'],
            ['path'  =>  'img/default/gallery/project/gold/gc_hosp2.jpg'],
            ['path'  =>  'img/default/gallery/project/gold/gc_hosp5.jpg'],
        ]);

        gallerySeeder($goldCoast, $goldCoastData);

        $aquatic = Project::create([
        	'name' => 'Alice Springs Aquatic ',
        	'description' => 'The Kwikloc Aquatic System is carefully designed and looks as fresh and invigorating as the day it was installed.',
        	'content' => '
        		<h3>The recently completed Alice Springs Aquatic Centre hosts the market leading Kwikloc Aquatic Aluminium Ceiling System</h3>
				<p class="ecxMsoNormal">From roof fixture to suspension methods, the Kwikloc Aquatic System is carefully designed, with the assistance of leading corrosion consultants, to avert unlike metal contact throughout the installation.&nbsp;&nbsp;With the demanding atmosphere of chlorine perpetuating these environments, designers can utilise this system with utmost confidence for Aquatic Centre Installations.</p>
				<p class="ecxMsoNormal">From Aluminium Wall Angle brackets, aluminium and stainless steel fixings, &nbsp;aluminium purlin clips, aluminium suspension rod and carefully double grommeted protection from unlike metal contact at the roof structure – this system has it all.&nbsp;</p>
				<p class="ecxMsoNormal">We remind the industry that the demanding atmosphere associated with chlorine use – will infiltrate not only the below ceiling area but above ceiling as well. Coupled with that, due to the shear forces, ceiling height and intermediary partitions, the potential for ceiling&nbsp;collapse cannot be treated with apathy.</p>
				<p class="ecxMsoNormal">After 4 years the Alice Spring Aquatic Centre Ceiling looks as fresh and invigorating as the day it was installed. Coupled with the RH100 OWA Aqua Cosmos tile, the ultimate Aquatic Centre ceiling solution is there for the longhaul.</p>
				<div class="gallery-main">
				<p><a class="product-link" title="Alice Springs Aquatic Centre" rel="prettyPhoto[gallery2]" href="http://www.studform.com.au/media/wysiwyg/Aquatic/Aquatic1.jpg">Click here to view the Image Gallery </a> <a class="product-link" style="display: none;" title="Alice Springs Aquatic Centre" rel="prettyPhoto[gallery2]" href="http://www.studform.com.au/media/wysiwyg/Base/aquatic/Aquatic5.jpg"> </a> <a class="product-link" style="display: none;" title="Alice Springs Aquatic Centre" rel="prettyPhoto[gallery2]" href="http://www.studform.com.au/media/wysiwyg/Base/aquatic/Aquatic6.jpg"> </a> <a class="product-link" style="display: none;" title="Alice Springs Aquatic Centre" rel="prettyPhoto[gallery2]" href="http://www.studform.com.au/media/wysiwyg/Base/aquatic/Aquatic4.jpg"> </a></p>
				</div>
        	',
        	'image' => 'img/default/project/aquatic-centre.jpg'

        ]);

        $aquaticData = collect([
            ['path'  =>  'img/default/gallery/project/aquatic/aquatic1.jpg'],
            ['path'  =>  'img/default/gallery/project/aquatic/aquatic4.jpg'],
            ['path'  =>  'img/default/gallery/project/aquatic/aquatic5.jpg'],
            ['path'  =>  'img/default/gallery/project/aquatic/aquatic6.jpg'],
        ]);

        gallerySeeder($aquatic, $aquaticData);
        
        $this->enableForeignKeys();
    }
}



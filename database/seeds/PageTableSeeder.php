<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;
use App\Models\Page;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PageTableSeeder extends Seeder
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
        $this->truncate('pages');


        $faker = Faker::create();

        Page::create([
            'name'          => 'Home',
            'description'   => null,
            'content'       => '
               Content
            ',
            'image'         => 'img/default/page/home/image.jpg',
            'priority'      => 1,
        ]);

        Page::create([
            'name'          => 'Contact Us',
            'description'   => 'Please feel free to contact us on any of the following methods or fill in the online enquiry:',
            'content'       => '<table>
                                <tbody>
                                <tr>
                                <td width="80px"><span style="font-size: large;">Freecall</span></td>
                                <td><span style="font-size: large;">1800 352 366</span></td>
                                </tr>
                                <tr>
                                <td><span style="font-size: large;">Phone</span></td>
                                <td><span style="font-size: large;">08 8726 2000</span></td>
                                </tr>
                                <tr>
                                <td><span style="font-size: large;">International</span></td>
                                <td><span style="font-size: large;">+61 8 8726 2000</span></td>
                                </tr>
                                <tr>
                                <td><span style="font-size: large;">Fax</span></td>
                                <td><span style="font-size: large;">08 8725 6800</span></td>
                                </tr>
                                <tr>
                                <td><span style="font-size: large;">Email</span></td>
                                <td><span style="font-size: large;"><a href="mailto:info@studform.com.au">info@studform.com.au</a></span></td>
                                </tr>
                                </tbody>
                                </table>',
            'image'         => 'img/default/page/contact/image.jpg',
            'priority'      => 2,
        ]);

        Page::create([
            'name'          => 'About',
            'description'   => '
                InspirationIt strikes and leaves a mark on your project
                – distinct, and designed to be suchSolutionsNot merely answers
                – but the ability to achieve unique outcomes.
            ',
            'content'       => '
                <h3>Studform Pty Ltd manufactures and distributes doors, access panels, aluminium ceiling systems, &amp; aluminium partitioning systems to the Australian and New Zealand construction markets - with export markets in Dubai and the United Kingdom being developed.</h3>
                <p>The Studform headquarters and manufacturing division is based in regional SA with sales offices in Adelaide and Brisbane.</p>
                <p>The Studform plant is committed to manufacturing products to stringent quality standards while conforming to the requirements of the GECA (Green Environmental Council of Australia) license conditions using controlled systems built upon principles of prevention, in-process control and continuous improvement.</p>
                <p>Contact Studform today on 1800 352 366 or complete our <a href="http://www.studform.com.au/contacts/" target="_self">enquiry form</a>.</p>&nbsp;<p></p></div>

            ',
            'image'         => 'img/default/page/about/image.jpg',
            'thumbnail'     => 'img/default/page/about/thumbnail.jpg',
        ]);

        Page::create([
            'name'          => 'Building Green',
            'description'   => '
                A core value at Studform is care for the environment. We believe there is a way of harvesting the rich natural resources our globe has to offer, while doing so in a sustainable manner.
            ',
            'content'       => '
                <p><strong><img style="margin-top: 5px; margin-right: 800px; float: left;" title="FSC Certification" src="http://i138.photobucket.com/albums/q276/shazzjr/FSCLogo.jpg" alt="FSC Logo" width="118" height="57"><br></strong></p>
                <p>Most Studform products are inherently eco friendly by nature of the raw materials used –&nbsp;typically plantation timber, recycled aluminium and recycled steel.</p>
                <p>Wherever possible such materials are sourced from companies with recognised sustainability credentials, and who are members of Chain of custody (CoC) certification programs such as FSC (Forest Stewardship Council)</p>
                <p>Ask us about FSC availability.</p>
                </div>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p><strong>Operations.</strong></p>
                <p>Careful attention is paid to our daily manufacturing and distribution operations to avoid unnecessary impact on our environment</p>
                <p>&nbsp;</p>

            ',
            'image'         => 'img/default/page/building-green/image.jpg',
            'thumbnail'     => 'img/default/page/building-green/thumbnail.jpg',
        ]);

        Page::create([
            'name'          => 'Specifications',
            'content'       => '
                <p style="font-size: 20px;">Branded worksections are technical worksections developed by NATSPEC in conjunction with a manufacture-known as a NATSPEC Product Partner. Each branded worksection is based on the associated NATSPEC generic worksection and shares the same classification number. It is a MS Word document Template which follows the NATSPEC style and can be customised.</p>
                <p><a href="http://www.natspec.com.au/images/PDF/NTN_GEN_008_Branded_vs_generic_worksections.pdf" target="_blank"><strong>NATSPEC TECHnote GEN 008</strong></a> defines both generic and branded worksections and outlines their advantages.</p>
                <h3>Advantages of NATSPEC branded worksections</h3>
                <ul>
                <li>An alternative to a generic worksection where a particular product has been selected at the design stage. Associated generic material not manufactured by the Product Partner is still provided.</li>
                </ul>
                <ul>
                <li>Minimal customising required as the <em>Template</em> has been approximately 90% pre-edited in conjunction with the Product Partner.</li>
                </ul>
                <ul>
                <li>Current product information is readily available and accessible via hyperlinks between the <em>Template</em> and the Product Partner&rsquo;s website reducing research time and facilitating early decision making.</li>
                </ul>
                <ul>
                <li>The possibility of product substitution by the contractor may be reduced as the unique performance characteristics of the product are clearly specified.</li>
                </ul>
                <ul>
                <li>Specifiers can rely on NATSPEC industry knowledge and regular updates of the relevant standards and building codes.</li>
                </ul>
                <h3 style="text-align: center;">Download below, or NATSPEC and AUS-SPEC subscribers through SPECbuilder Live.&nbsp;</h3>
                <div class="technical-documents">
                <table>
                <tbody>
                <tr>
                <td><img class="product-image" style="margin-top: 35px;" src="/media/wysiwyg/Documents/seismic.jpg" alt="" width="100"></td>
                <td class="middle">
                <h4>0531p STUDFORM IN SUSPENDED CEILINGS – COMBINED</h4>
                </td>
                <td class="right"><a class="download pdf" href="http://www.natspec.com.au/images/branded_worksections/0531p_STUDFORM_in_suspended_ceilings__combined.pdf" target="_blank">Download PDF</a> <a class="download dwg" href="/media/wysiwyg/Documents/0531p_STUDFORM_in_suspended_ceilings__combined.docx" target="_blank">Download DOCX</a></td>
                </tr>
                </tbody>
                </table>
                </div>

            ',
            'image'         => 'img/default/page/specified/image.jpg',
        ]);
        
        Page::create([
            'name'          => 'Projects',
            'content'       => '
                We are proud to have been involved in many exciting and successful projects and developments.
            ',
            'image'         => 'img/default/page/specified/image.jpg',
            'priority'      => 3
        ]);

        Page::create([
            'name'          => 'Products',
            'content'       => '
                Content
            ',
            'image'         => 'img/default/page/specified/image.jpg',
            'priority'      => 4
        ]);
        Page::create([
            'name'          => 'Brochures',
            'content'       => '
                Downloads from Studform
                Studform has a large number of brochures for our customer to download and view. Please click the below images to download a corresponding PDF brochure. 
            ',
            'image'         => 'img/default/page/specified/image.jpg',
            'priority'      => 5
        ]);
        $this->enableForeignKeys();
    }
}



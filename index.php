<?php
session_start();


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Kezdőlap</title>
        <meta charset="utf-8">
        <link rel = "stylesheet" type="text/css" href="desing.css">
        <link rel="icon" tpye="image/png" href="Closed_Book_Icon.svg" size="32x32">
    </head>
    <body>
        <nav>
            <ul id="menu1">
				<li><a href= "index.php">Főoldal</a></li>
				<li><a href= "lista.php">Saját gyűjtemény</a></li>
				<li><a href= "feltoltes.php">Feltöltés</a></li>
               <?php if(isset($_SESSION["Felhasznalo"]))
                         {
                             echo '<li class="jobb"><a href="logout.php">Kilépes</a></li>';
                             echo '<li class="jobb">'.$_SESSION["Felhasznalo"].'</li>';
                        }else {
                            echo '<li class="jobb"><a href="account.php">Belépés/Regisztráció</a></li>';
                        }
                ?>            
			</ul>
        </nav>
        <h2>Üdvözlünk, könyveid a saját gyűjteményre kattintva találod!</h2>
        <br>
        <?php
            if(!isset($_SESSION["Felhasznalo"])) {
                echo '<ul id="menu4">';
                echo '<li> Feltöltéshez regisztrálj/jelentkezz be!</li>'; 
                echo '<li> Saját gyűjteményhez regisztrálj/jelentkezz! </li>'; 
                echo '</ul>';
            }
        ?>
        <nav>
            <h2>A legjobb könyvek műfajok szerint</h2>
            <ul id="menu3">
                <li> <a href="https://irating-hu.techexpertolux.com/top-10-luchshih-knig-v-zhanre-antiutopiya-opisaniya-otzyvy-plyusy-i-minusy-sovety-po-vyboru/"target="_blank">A top 10 legjobb Disztópia könyv</a></li>
                <li> <a href="https://www.book24.hu/hir/legjobb-fantasy-konyvek"target="_blank">A top 10 legjobb Fantasy könyvek</a></li>
                <li> <a href="https://hu.gov-civ-guarda.pt/7-best-alan-watts-books-philosophy"target="_blank">A top 7 legjobb Filozófia könyvek</a></li>
                <li> <a href="https://fmc.hu/2017/03/10/a-15-legjobb-ifjusagi-konyv-amit-felnott-fejjel-is-erdemes-elolvasni"target="_blank">A top 15 legjobb Ifjúsági könyv</a></li>
                <li> <a href="https://www.scifimarket.hu/top-5-sci-fi-konyv-2015-2016-sfm0" target="_blank">A top 5 legjobb Sci-fi könyv</a></li>
                <li> <a href="https://funzine.hu/2020/11/18/kult/online-konyvajanlo-5-lebilincselo-romantikus-regeny/"target="_blank">A top 5 legjobb Romantikus könyvek</a></li>
            </ul>
        </nav>

        <br>
        <br>
        <br>
        <h2>A könyvekről</h2>
        <p>
            A könyv (nyomtatott papírkönyv) az UNESCO meghatározása szerint: Olyan, szövegből és ábrából álló, fizikai (papír) információhordozójú, nem periodikus (irodalmi vagy szakmai célú) publikáció, amely 49 vagy több oldalból áll, terjedelmi szempontból a borítót nem számítva. A könyv nyomdaipari sokszorosítással előállított tömegtermék.
            Emellett könyvnek nevezik nagyobb lélegzetű művek egyes önmagukban is zárt részeit, különösen ha egy kötetben jelennek meg. Ez különösen régebbi művek esetén használatos, amelyek eredetileg könyvtekercsre íródtak, és több könyvtekercs alkotta a teljes művet. Erre példák szent iratok, a Biblia, az Aeneis és több történelemmel foglalkozó mű az ókorból és a középkorból.
            A könyv kultúrtermék, aminek feltétele az írástudás elterjedése és az írott nyelv fejlődése. Kommunikációs eszközként való használata feltételez írástudást, írói kompetenciát, továbbá nyomdatechnika rendelkezésre állását.
            Az elektronikusan tárolt könyvszövegeket digitális könyveknek vagy e-könyveknek nevezik. Egy másik modern változat a hangoskönyv.
        </p>
        <p>
        Az ókortól a 20. század közepéig a legfontosabb és legelterjedtebb információhordozó médium. Megjelenési formája változatos, leginkább összefűzött vagy -kötött, többnyire papír alapú lapokból áll. A papír tömeggyártása előtt pergament használtak. A lapokra felvitt jelek hordozzák az információt. A hagyományosan valamilyen nyelven, írásban, szövegként rögzített információt az olvasás művelete segítségével kapjuk vissza. Képi információt (illusztrációt) is tartalmazhat.
        Használatának megkönnyítésére a lapok oldalait számozzák, a tartalom részei közötti eligazodást a tagolás és a tipográfia mellett külön tartalomjegyzék, tárgymutató vagy névmutató is segítheti.
        </p>
        <h3>Története</h3>
        <h4>A középkori kéziratos könyvek</h4>
        <p>
        A könyv közvetlen elődjének a legtöbbször pergamenre kézzel írt, összefüggő szöveget alkotó kéziratos könyvet tekinthetjük. A középkori Európa egyre fejlődő tudományos élete jelentős számú szöveg másolását tette szükségessé.
        Az ókortól a kora középkorig a leggyakoribb kéziratos könyv a kódex volt, amely küllemében a mai könyvre emlékeztetett, mivel az elhasználódástól védő borítója, gerince volt, és lapjait összefűzték.
        A kéziratos könyv a mai könyvtől eltérő olvasótábor igényeit elégítette ki, és készítésének technikai lehetőségei miatt jelentősen eltért attól. A kéziratos könyvet elsősorban a papság, a királyi közigazgatás, a feudális főurak és az egyetemek polgárai használták. Elvileg minden kéziratos könyv egyedi darab volt, ezért a ma szokásos könyvazonosítási módszerek nem voltak használhatók: a lapokat nem számozták, a szövegeket fejezetekre és bekezdésekre tagolták, és ezeket látták el számokkal. A könyvnek nem volt címlapja, kolofonja, a másoló nevét nem rögzítették. Néhány jelentős művet a középkorban rendszeresen használtak és másoltak, ezek idézésmódja a kéziratos könyvekből maradt ránk (például Biblia, illetve a Corpus Iuris Civilis könyvei).
        A kéziratos könyvek egy része luxuskivitelben készült, gazdag illusztrációval, kiváló minőségű pergamenre festve. A könyv kalligráfiája, kézírásának képe művészi kivitelű volt. Ilyen kivitelben főleg vallási művek, illetve törvénykönyvek, kódexek készültek. Az egyetemi polgárság számára jóval egyszerűbb kivitelű és a késő középkorban a 14. századtól már gyakran papírra írt kéziratos könyvek készültek, mert a papír olcsóbb és könnyebben előállítható volt. A szegényebb diákok egyetemi éveik alatt maguk készítették el kéziratos könyvtárukat.
        A könyvek egyházon kívüli olvasása, az írni-olvasni tudás, az ezzel járó kulturáltság nem mindig érdemelt ki tiszteletet a köznép körében. Könyves Kálmán király olvasott ember volt, „könyves” neve viszont akkoriban nem dicsérő, hanem inkább gúnyolódó jelző volt: ma a „könyvmoly” szót használnánk helyette.
        </p>
        <h4>Gutenberg és a nyomda feltalálása</h4>
        <p>
        A könyvnyomtatás feltalálását Európában a legtöbben Johannes Gutenberg nevéhez kötik, aki a mozgatható betűnyomás legvalószínűbb feltalálója. Gutenberg az aranyműves társaival, illetve több más mester tőle függetlenül már az 1430-as években kísérletezett egy olyan mechanikus sokszorosítási eljárással, amivel szövegeket lehet reprodukálni. Azzal a technikával, amit könyvnyomtatásnak nevezhetünk, vélhetőleg ő tudott először az 1440-es évek végén kisebb füzetet, majd három év munkájával egy teljes Bibliát kinyomtatni. Koreában már 200 évvel korábban már nyomtattak mozgatható fém írásjegyekkel, ami gyaníthatóan a kínai agyag írásjegyek továbbfejlesztése volt. Ezt azonban ritkán használták.
        Gutenberg találmányának lényege az önállóan használható, a szedés során újrarendezhető betű nyomóformák (karakterek) használata egy olyan egyszerű sajtó segítségével, amivel egy teljes papír- vagy pergamenívet tele lehetett nyomtatni, majd az íveket lapok szerint rendezve könyv alakba lehetett fűzni.
        A könyvnyomtatás technikája elterjesztette a drága pergamen helyett az egyre jobb minőségű és egyre olcsóbban elérhető papír használatát. Ugyan a betűmetszés és betűöntés kezdetben fáradságos és drága művelet volt, a mechanikus sokszorosítás és kéziratoknál ritkán használt papír egyre nagyobb kínálata összességében olcsóbb és megbízhatóbb terméket eredményezett a kódexeknél és másolt kéziratoknál. Már Gutenberg első, kezdetleges technikával, és nagy műgonddal készült 42 soros Bibliája is fele akkora költséggel készült, mint egy kézírásos Biblia. A nyomtatás folyamatos fejlődése és gyors elterjedése tömegáruvá tette a könyvet. Ez segítette a reformáció és a felvilágosodás terjedését.
        Az első könyvek vagy ősnyomatok a középkori kéziratos könyvek és a mai könyvek közötti átmenetet képeztek. Az első nyomdászok a kéziratok írásképét, szerkesztési módját igyekeztek másolni, és gyakran kézzel illusztrálták, vagy festett iniciálékkal látták el műveiket. A könyvek illusztrálására használt fametszet a rendszeres olvasásban még gyakorlatlan új vásárlói kör számára könnyítette a szöveg megértését.
        </p>
        <h4>A modern könyv</h4>
        <p>
        A Gutenberg-féle eljárás helyét fokozatosan átvették a különböző rotációs technikák, ahol a nyomóforma nem sík, hanem henger alakú, így nyomtatás folyamatosan történik.
        A következő lényeges lépés az offset gépek elterjedése volt, amikor a nyomóhenger sík, és különböző bevonatok biztosítják, hogy a festék a szükséges helyeken megtapadjon, máshol ne.
        A digitális nyomtatás lehetővé teszi a szükség szerinti gyors kiadást, akár papír-, akár kemény kötésben. Néhány szolgáltató Interneten kínálja fotókönyvek előállítását, amelyekből megegyezés szerint kevés, akár egy példány is előállítható. 2009-től a Wikipédia cikkeiből is lehet igény szerinti könyvet összeállítani. Az e-könyv 2000-ben jelent meg, és az Internet is konkurrenciát jelent a könyvek számára.
        A középkorban a szöveg és a képek egy egységet alkottak. A 20. században a Bauhaus művészei nyomdai grafikával illusztrált művészkönyveket adtak ki limitált kiadásban.
        2004-ben a Mazda egy 3,07 x 3,42 m oldalú képeskönyvet adott ki.
        A ma létező legnagyobb könyv a tervek szerint 2008 végére készül el a Borsod megyei Arnóton: lapjai 3,5 × 4 méteresek lesznek, terjedelme pedig eléri majd a 320 oldalt. A kötet a Törékeny természet címet kapja majd, és a gömör-tornai karsztvidéket, illetve a határokon átnyúló természeti értékeket fogja bemutatni számos fotóval. A Verlag Faber & Faber egy 2,4 × 2,9 mm oldalú, 32 oldalas könyvet készített offsetnyomással és kézi bőrkötéssel.
        <ul>
            <li>2010-ben a Google 130 millióra becsülte a különböző könyvek (nem a példányok) számát. Azonban megjegyezte, hogy a pontos szám attól függ, hogy mit tekintünk könyvnek.[8]</li>
            <li>Az UNESCO 1995-ben április 23-át a könyv napjává nyilvánította.[</li>
            <li>A legtöbbet nyomtatott könyv a Biblia. A Német Bibliatársulat szerint a teljes Bibliát 2015 januárjáig 542 nyelvre fordították le, és további 2344 nyelven jelentek meg belőle részletek.</li>
            <li>A Manesse-kódexet (egy középkori daloskönyv) egy 2006-os kiállításon 50 millió euróért kellett biztosítani.</li>
            <li>Az Evangeliar Heinrichs des Löwen 12. századi kéziratos könyvet 1983 december 6-án a londoni Sotheby’s árverésén 32,5 német márkáért ütötték le</li>
            <li>John James Audubons Birds of America könyvének aláírásos kiadása[12] a Christie’s egy 2000-es árverésén több, mint 8,8 millió amerikai dollárért kelt el.</li>
            <li>Kopernikusztól a De revolutionibus orbium coelestium első, 1543-as kiadása 2008-ban a Christie’s árverésén 2,2 millió amerikai dollárért talált új gazdára.</li>
        </ul>
        </p>
    </body>
</html>
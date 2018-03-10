#!/usr/bin/php
<?PHP

function file_manager($logs, $file_path, $id)
{
	if (file_exists($file_path) == TRUE)
	{
		$content = file_get_contents($file_path);
		$content = unserialize($content);
		$content[] = $logs;
		$final = $content;
	}
	else
		$final[0] = $logs;
	if ($final != NULL)
	{
		$content = serialize($final);
		if (file_exists('private/') == FALSE)
			mkdir('private/');
		file_put_contents($file_path, $content);
	}
	else
		echo 'ERROR';
}

$logs = NULL;
$logs['login'] = 'lchety';
$logs['passwd'] = hash('whirlpool', '311090');
$logs['f_name'] = 'Loic';
$logs['l_name'] = 'Chety';
$logs['address'] = 'XxX';
$logs['pc'] = 'XxX';
$logs['city'] = 'XxX';
$logs['rank'] = 'admin';
file_manager($logs, 'private/account');
$logs = NULL;
$logs['login'] = 'jpicot';
$logs['passwd'] = hash('whirlpool', '170294');
$logs['f_name'] = 'Julien';
$logs['l_name'] = 'Picot';
$logs['address'] = '17 rue Jules Guesde';
$logs['pc'] = '92300';
$logs['city'] = 'LEVALLOIS-PERRET';
$logs['rank'] = 'admin';
file_manager($logs, 'private/account');

$logs = NULL;
$logs['tag'] = 'vibro';
$logs['name'] = 'Vibromasseurs';
file_manager($logs, 'private/tags');
$logs = NULL;
$logs['tag'] = 'gode';
$logs['name'] = 'Godes';
file_manager($logs, 'private/tags');
$logs = NULL;
$logs['tag'] = 'plug';
$logs['name'] = 'Plugs';
file_manager($logs, 'private/tags');
$logs = NULL;
$logs['tag'] = 'stimu';
$logs['name'] = 'Stimulateurs';
file_manager($logs, 'private/tags');
$logs = NULL;
$logs['tag'] = 'gadget';
$logs['name'] = 'Gadgets';
file_manager($logs, 'private/tags');
$logs = NULL;
$logs['tag'] = 'toys_men';
$logs['name'] = 'Sextoys pour hommes';
file_manager($logs, 'private/tags');
$logs = NULL;
$logs['tag'] = 'toys_women';
$logs['name'] = 'Sextoys pour femmes';
file_manager($logs, 'private/tags');
$logs = NULL;
$logs['tag'] = 'xxl';
$logs['name'] = 'King Size';
file_manager($logs, 'private/tags');

$logs = NULL;
$logs["product"] = 'Vibromasseur Big Moss G5';
$logs["type1"] = 'vibro';
$logs["type2"] = 'xxl';
$logs["type3"] = 'toys_women';
$logs["picture"] = 'http://www.senkys.com/prodimg/300x420/19843_1.jpg';
$logs["carac"] = 'Cet élégant vibromasseur d\'une conception irréprochable s\'adresse à celles qui n\'ont pas froid aux yeux. Sa soyeuse texture en silicone est un régal, il est d\'ailleurs totalement étanche et silencieux. 
Légèrement incurvé, il vous fera frisonner de plaisir avec ses 12 modes de vibration, dont l\'intensité est réglable via touches sensorielles. Son extrémité en forme d\'anneau permet une prise en main parfaite.
Fonctionne avec le chargeur USB Click \'n\' Charge (inclus), compatible avec les sextoys de marque fun Factory. Economique et écologique. Garanti fabricant 1 an.';
$logs["mark"] = 'Fun Factory';
$logs["price"] = "99.95";
$logs["rank"] = 'hot';
file_manager($logs, 'private/shop');

$logs = NULL;
$logs["product"] = 'Anneau a penis vibrant "Double Pleasure"';
$logs["type1"] = 'toys_men';
$logs["type2"] = 'vibro';
$logs["picture"] = 'http://www.senkys.com/prodimg/300x420/19915_1.jpg';
$logs["carac"] = 'Marre de la routine au lit ? Cet anneau pénien se définit comme la solution ultime pour pimenter vos ébats. Fabriqué dans une matière lisse et douce, il va renforcer l\'érection tout en stimulant délicieusement le clitoris de la partenaire par de puissantes vibrations et de petits ergots. A utiliser sans modération.'; 
$logs["mark"] = 'Glamy';
$logs["price"] = '8.95';
$logs["rank"] = 'basic';
file_manager($logs, 'private/shop');

$logs = NULL;
$logs["product"] = 'Stimulateur pour couple "Partner Whale"';
$logs["type1"] = 'stimu';
$logs["type2"] = 'toys_men';
$logs["type3"] = 'toys_women';
$logs["picture"] = 'http://www.senkys.com/prodimg/300x420/19939_2.jpg';
$logs["carac"] = '"Après le Partner et le Partner Plus, découvrez le Partner Whale aux vibrations TRES puissantes !"
Ce stimulateur en silicone pour couple va vous plonger au c½ur d\'un plaisir sensationnel. Destiné aux couples voulant s\'aventurer dans une expérience intense à travers 10 modes de vibrations qui viendront stimuler les deux partenaires de façon simultanée lors de vos rapports.
Il est composé d\'une première partie avec un moteur puissant qui stimule le clitoris et le pénis et la seconde partie plus souple se place directement dans le vagin afin d\'atteindre le point G.
Son design offre une meilleur prise en main et son reliefs permet une stimulation encore plus profonde pour provoquer des orgasmes stupéfiants.
Étanche vous pourrez également l\'utilisé pour des moments coquins sous la douche.'; 
$logs["mark"] = 'Satisfyer';
$logs["price"] = '49.95';
$logs["rank"] = 'basic';
file_manager($logs, 'private/shop');

$logs = NULL;
$logs["product"] = 'Vibromasseur "Classic Slim Purple"';
$logs["type1"] = 'toys_women';
$logs["type2"] = 'xxl';
$logs["type3"] = 'gode';
$logs["picture"] = 'http://www.senkys.com/prodimg/300x420/19761_2.jpg';
$logs["carac"] = '"Son relief vous procurera un plaisir insoupçonné"
Ce vibromasseur en silicone, est silencieux et étanche. Il comporte un relief réaliste, qui, combinés à de puissantes vibrations, vous offrira de merveilleux instants de plaisir.
Sa molette de réglage, permet de faire varier l\'intensité des vibrations aisément afin de vous conduire au nirvana crescendo.'; 
$logs["mark"] = 'Toy Joy';
$logs["price"] = '21.95';
$logs["rank"] = 'hot';
file_manager($logs, 'private/shop');

$logs = NULL;
$logs["product"] = 'Plug anal "Primal Attraction"';
$logs["type1"] = 'plug';
$logs["type2"] = 'stimu';
$logs["picture"] = 'http://www.senkys.com/prodimg/300x420/19754_1.jpg';
$logs["carac"] = '"Collection Darker"
Ce plug anal de la collection officielle de Fifty Shades of Grey vous fera entrer dans l\'univers sombre de C.Grey. Fabriqué en silicone doux, ce plug à la forme conique, au design ergonomique, est doté d\'une bille métallique à l\'intérieur pour stimuler votre anus a chaque mouvement permettant d\'accroître votre excitation avant des moments torrides.
Livré avec une pochette de rangement satiné.'; 
$logs["mark"] = 'FIFTY SHADES OF GREY';
$logs["price"] = '29.95';
$logs["rank"] = 'basic';
file_manager($logs, 'private/shop');

$logs = NULL;
$logs["product"] = 'Masseur Prostatique "HIM"';
$logs["type1"] = 'gadget';
$logs["type2"] = 'plug';
$logs["type3"] = 'toys_men';
$logs["picture"] = 'http://www.senkys.com/prodimg/300x420/19349_1.jpg';
$logs["carac"] = '"Vous êtes joueur ? Découvrez le point P"
Ce masseur prostatique en silicone ultra doux et, aux courbes ergonomiques permettant une une parfaite stimulation de votre périnée et de votre anus, est doté de deux moteurs puissants. Son extrémité est munie d\'une bille dont le mouvement de va-et-vient stimule votre prostate pour un plaisir unique. Avec ses 8 modes de vibrations gérés par une télécommande sans fil (à la portée de 4 mètres), vous pourrez laisser votre partenaire prendre les commandes et varier les sensations. A utiliser avec un lubrifiant à base d\'eau.'; 
$logs["mark"] = 'Love To Love';
$logs["price"] = '99.95';
$logs["rank"] = 'basic';
file_manager($logs, 'private/shop');

$logs = NULL;
$logs["product"] = 'Scotch de bondage';
$logs["type1"] = 'gadget';
$logs["picture"] = 'http://www.senkys.com/prodimg/300x420/17145_1.jpg';
$logs["carac"] = '"Réalisez vos fantasmes de domination et soumission"
Alliez esthétisme et efficacité lors de vos jeux de domination. Ce rouleau de bande de scotch en vinyle se maintient fermement à la peau sans coller car il adhère sur lui-même grâce à l\'électricité statique. Ne colle pas aux cheveux. Réutilisable.'; 
$logs["mark"] = 'Pipedream';
$logs["price"] = '11.90';
$logs["rank"] = 'hot';
file_manager($logs, 'private/shop');

$logs = NULL;
$logs["product"] = 'Fouet cuir "Cane"';
$logs["type1"] = 'gadget';
$logs["type2"] = 'stimu';
$logs["picture"] = 'http://www.senkys.com/prodimg/300x420/12940_1.jpg';
$logs["carac"] = '"Votre partenaire aurait-il été méchant ?"
Idéal pour flageller les partenaires les plus insolents, cet instrument nécessite une certaine dextérité pour le manier avec précision et efficience. Il est constitué d\'une longue corde tressée de cuir véritable, de lanières ainsi que d\'une anse souple. A réserver aux personnes masochistes et initiées car la douleur est forte.'; 
$logs["mark"] = 'Inconnue';
$logs["price"] = '36.95';
$logs["rank"] = 'basic';
file_manager($logs, 'private/shop');

$logs = NULL;
$logs["product"] = 'Vibro Rabbit "Knobbly Wobbly"';
$logs["type1"] = 'vibro';
$logs["type2"] = 'toys_women';
$logs["type3"] = 'xxl';
$logs["picture"] = 'http://www.senkys.com/prodimg/300x420/11118_1.jpg';
$logs["carac"] = '"Un jouet au design original pour une double stimulation des plus agréable" Ce vibromasseur à la texture très douce comporte de nombreux picots sur toute sa surface pour une stimulation idéale des parois vaginales. Le stimulateur clitoridien en forme de lapin vibre quant à lui jusque son extrémité, pour parfaire les sensations ainsi procurées. L\'intensité des vibrations de ce jouet est réglable facilement à l\'aide de la molette située à sa base.'; 
$logs["mark"] = 'Toy Joy';
$logs["price"] = '14.90';
$logs["rank"] = 'hot';
file_manager($logs, 'private/shop');

$logs = NULL;
$logs["product"] = 'Masturbateur Tenga "Egg Spider"';
$logs["type1"] = 'stimu';
$logs["type2"] = 'toys_women';
$logs["type3"] = 'gadget';
$logs["picture"] = 'http://www.senkys.com/prodimg/300x420/16631_1.jpg';
$logs["carac"] = '"Osez vous frotter à son relief exclusif"
Venu tout droit du japon, l\'oeuf Tenga est une gaine de masturbation extensible, conçue en silicone ultra-doux. Ce modèle dispose d\'un relief interne en toile d\'araignée vous garantissant un plaisir totalement inouï. Déployez la gaine et insérez votre gland puis massez selon vos envies. Réutilisable, il suffit de le nettoyer avec de l\'eau et du savon. Dosette de lubrifiant incluse.'; 
$logs["mark"] = 'Tenga';
$logs["price"] = '6.20';
$logs["rank"] = 'basic';
file_manager($logs, 'private/shop');

$logs = NULL;
$logs["product"] = 'Mini Plug Vibrant "Slimine"';
$logs["type1"] = 'plug';
$logs["type2"] = 'vibro';
$logs["type3"] = 'toys_women';
$logs["picture"] = 'http://www.senkys.com/prodimg/300x420/11036_1.jpg';
$logs["carac"] = '"Des dimensions idéales pour s\'initier en douceur"
Fabriqué en matière douce, ce mini plug vibrant offre des dimensions et une forme ergonomique parfaitement adaptées à l\'initiation au plaisir anal. Il comporte à sa base une molette permettant de régler l\'intensité des vibrations émises.'; 
$logs["mark"] = 'Inconnue';
$logs["price"] = '15.90';
$logs["rank"] = 'basic';
file_manager($logs, 'private/shop');

$logs = NULL;
$logs["product"] = 'Vibro Anal "Anal probe"';
$logs["type1"] = 'vibro';
$logs["type2"] = 'plug';
$logs["type3"] = 'toys_men';
$logs["picture"] = 'http://www.senkys.com/prodimg/300x420/19826_1.jpg';
$logs["carac"] = '"Envolez-vous vers des plaisirs insoupçonnés" Conçu en matière lisse et douce, ce vibromasseur très fin comporte un système de vibrations réglables. De part son diamètre étroit, ce jouet à la forme légèrement conique est idéal pour s\'initier au plaisir anal en douceur.'; 
$logs["mark"] = 'California Exotic';
$logs["price"] = '9.30';
$logs["rank"] = 'basic';
file_manager($logs, 'private/shop');

/*$logs = NULL;
$logs["product"] = '';
$logs["type1"] = '';
$logs["type2"] = '';
$logs["type3"] = '';
$logs["picture"] = '';
$logs["carac"] = ''; 
$logs["mark"] = '';
$logs["price"] = '';
$logs["rank"] = '';
file_manager($logs, 'private/shop');
*/

?>

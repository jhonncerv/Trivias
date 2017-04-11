<?php

use Illuminate\Database\Seeder;

class PostalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $var = array(
            'postales/Marruecos01.png',
            'postales/Marruecos02.png',
            'postales/Marruecos03.png',
            'postales/Marruecos04.png',
            'postales/Marruecos05.png',
            'postales/Japon01.png',
            'postales/Japon02.png',
            'postales/Japon03.png',
            'postales/Japon04.png',
            'postales/Japon05.png',
            'postales/India01.png',
            'postales/India02.png',
            'postales/India03.png',
            'postales/India04.png',
            'postales/India05.png',
            'postales/Argentina01.png',
            'postales/Argentina02.png',
            'postales/Argentina03.png',
            'postales/Argentina04.png',
            'postales/Argentina05.png',
            'postales/Inglaterra01.png',
            'postales/Inglaterra02.png',
            'postales/Inglaterra03.png',
            'postales/Inglaterra04.png',
            'postales/Inglaterra05.png',
        );

        $share_text = array(

            [
                'En los hogares de Marruecos el hombre es el encargado de servir el té.',
                'En Marruecos, mientras se bebe el té en una tienda, no es correcto hablar de precios ni negociar hasta que se vacíen los vasos.',
                'El té ocupa un puesto muy importante en la cultura de Marruecos y es considerada una expresión artística.',
                'En Marruecos no existe una forma estándar de preparación del té, y es habitual que cada marroquí lo prepare a su manera.',
                'Debido a su consumo, Marruecos es uno de los mayores importadores de té en el mundo.',

            ],

            [
                'El té verde es el preferido por los japoneses. Esa variedad acapara el gusto de la gran mayoría de nipones.',
                'En Japón y otros países orientales, el té transporta a un estrado de solemnidad.',
                'En Japón debes degustar primero el té en su estado puro, sin añadir nada.',
                'El té fue introducido en Japón durante el siglo IX por los monjes budistas de China, donde se conocía, según la leyenda, desde hacía milenios.',
                'En las ciudades actuales, donde no hay mucho espacio, la ceremonia del té puede hacerse en cualquier lugar de la casa adaptado para ello; lo importante es ofrecer un entorno tranquilo con el espíritu de la ceremonia.',
            ],

            [
                'India es el mayor productor de té, y Assam, Darjeeling y Nilgiri, las principales regiones de cultivo. Comparte con tus amigos esta postal.',
                'En India es casi obligatorio ofrecer un té a las visitas. Se considera mala educación rechazar el té que te ofrecen por primera vez.',
                'Ya sea con leche o con azúcar, el té más consumido por la población de la India es el negro.',
                'La India es el mayor productor de té que existe sobre la faz de la tierra.',
                'Ya sea para desayunar, para beber por las tardes o en cualquier otro momento del día, el té se impone como la bebida por excelencia del pueblo indio.',
            ],

            [
                'Argentina es el noveno productor de té en el mundo.',
                'La relación entrañable que tiene el té con Argentina, es la famosa ceremonia del té galés que se celebra regularmente en la Patagonia.',
                'El té comenzó a cultivarse en Argentina a principios del siglo XX, y desde hace años, muchas marcas internacionales utilizan en sus productos, el té cultivado en Argentina.',
                'La costumbre de tomar el té, traída principalmente por los inmigrantes europeos, se adoptó rápidamente, y la reunión en torno a él es cada vez más común. ',
                'Las personas se reúnen alrededor de la mesa para disfrutar de sándwiches, tortas, scones, una rica taza de té y mucha conversación.',
            ],

            [
                'El té forma parte de la cotidianidad de las islas y una buena taza de té lo puede solucionar todo.',
                'En Inglaterra, después de remover el té, la cuchara se debe colocar  sobre el plato.',
                'Fue la duquesa Ana Russell quien inició la costumbre del té en Inglaterra a mediados del siglo XIX, como una forma de tomar un tentempié entre las largas horas.',
                'Los ingleses, a la hora de beber el té, lo beben sólo, con azúcar o con leche. Se inclinan generalmente por los "blends" y nunca lo sirven con crema.',
                'En Inglaterra nunca se sopla por encima de la taza para que se enfríe, se considera de mal gusto. Se remueve con la cucharilla.',
            ],

        );

        $pre = '/postal/';
        $ciudad = array('Marruecos', 'Japon', 'India', 'Argentina', 'Inglaterra');
        for ($i = 1; $i <= 5; $i++ ){
            for ($j = 1; $j <= 5; $j++ ){
                $postal = new \App\Postal();
                $postal->name = strtolower($ciudad[$i-1]).'-'.$j;
                $postal->url = $pre.$ciudad[$i-1].'0'.$j.'.png';
                $postal->meta = $share_text[$i-1][$j-1];
                $postal->points = 10;
                $postal->ciudad_id = $i;
                $postal->save();
            }
        }
    }
}

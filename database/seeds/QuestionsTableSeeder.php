<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('preguntas')->delete();

        for ($i=1; $i < 6 ; $i++) { 
            # code...
        

        //pregunta 1
        \DB::table('preguntas')->insert(array(
        		'examen_id'	=>	$i,
        		'pregunta'	=>	'La Administración Electrónica...',
        		'resp_a'	=>	'Implica el uso de las TIC en las Administraciones Públicas.',
        		'resp_b'	=>	'Requiere cambios organizativos.',
        		'resp_c'	=>	'Nuevas capacidades en los empleados públicos.',
        		'resp_d'	=>	'Todas las anteriores.',
        		'correcta'	=>	'resp_d'
        	));

        //pregunta 2
        \DB::table('preguntas')->insert(array(
        		'examen_id'	=>	$i,
        		'pregunta'	=>	'Una infraestructura de clave pública es el conjunto de elementos hardware y software,...',
        		'resp_a'	=>	'Así como políticas y procedimientos que permiten llevar a cabo la gestión de las aplicaciones de administración electrónica.',
        		'resp_b'	=>	'Que permiten gestionar el ciclo de vida de los certificados digitales.',
        		'resp_c'	=>	'Así como políticas y procedimientos que permiten llevar a cabo la gestión y el control de vida de los certificados digitales.',
        		'resp_d'	=>	'Ninguna de las anteriores es correcta.',
        		'correcta'	=>	'resp_b'
        	));

        //pregunta 3
        \DB::table('preguntas')->insert(array(
        		'examen_id'	=>	$i,
        		'pregunta'	=>	'¿Quién mantiene actualizada la CRL?',
        		'resp_a'	=>	'La Autoridad de Certificación.',
        		'resp_b'	=>	'La Autoridad de Registro.',
        		'resp_c'	=>	'La Autoridad de Revocación.',
        		'resp_d'	=>	'Los poseedores de un certificado digital.',
        		'correcta'	=>	'resp_a'
        	));

        //pregunta 4
        \DB::table('preguntas')->insert(array(
        		'examen_id'	=>	$i,
        		'pregunta'	=>	'¿Qué tipo de certificado permite identificar una cualidad, estado o situación?',
        		'resp_a'	=>	'Certificado de representante.',
        		'resp_b'	=>	'Certificado de pertenencia a empresa.',
        		'resp_c'	=>	'Certificado de atributo.',
        		'resp_d'	=>	'Certificado mixto.',
        		'correcta'	=>	'resp_c'
        	));

        //pregunta 5
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  'SL proporciona...',
                'resp_a'    =>  'Autenticación y confidencialidad.',
                'resp_b'    =>  'Autenticación y no repudio.',
                'resp_c'    =>  'Autenticación, confidencialidad, integridad y no repudio.',
                'resp_d'    =>  'Autenticación, confidencialidad e integridad.',
                'correcta'  =>  'resp_c'
            ));

        //pregunta 6
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  'Con respecto a los subprotocolos de TLS/SSL:',
                'resp_a'    =>  'Record encapsula el tráfico.',
                'resp_b'    =>  'Handshake se encarga únicamente de la autenticación.',
                'resp_c'    =>  'Change Cipher Spec cambia a modo cifrado.',
                'resp_d'    =>  'Todas las respuestas anteriores son correctas.',
                'correcta'  =>  'resp_c'
            ));
        
        //pregunta 7
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  'Señale la afirmación FALSA con respecto a TLS/SSL...',
                'resp_a'    =>  'El cliente siempre envía su certificado.',
                'resp_b'    =>  'El servidor siempre envía su certificado.',
                'resp_c'    =>  'Conexiones posteriores del mismo cliente reusarán la sesión existente y se establecerán más rápidamente.',
                'resp_d'    =>  'La sesión se reinicia cuando se reinicia el servidor o el cliente.',
                'correcta'  =>  'resp_a'
            ));

        //pregunta 8
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  '¿Cuál es la Ley de Firma Electrónica?',
                'resp_a'    =>  'Ley59/2003.',
                'resp_b'    =>  'Ley11/2007.',
                'resp_c'    =>  'Ley59/1999.',
                'resp_d'    =>  'Ley15/1999.',
                'correcta'  =>  'resp_a'
            ));

        //pregunta 9
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  'Un certificado digital se corresponde, siendo precisos, con:',
                'resp_a'    =>  'Firma electrónica.',
                'resp_b'    =>  'Firma electrónica avanzada.',
                'resp_c'    =>  'Firma electrónica reconocida.',
                'resp_d'    =>  'Firma electrónica regulada.',
                'correcta'  =>  'resp_c'
            ));

        //pregunta 10
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  '"Aquella dirección electrónica disponible para los ciudadanos a través de redes de telecomunicaciones cuya titularidad, gestión y administración corresponde a una Administració Pública, órgano o entidad administrativa en el ejercicio de sus competencias". ¿Qué concepto estamos definiendo?',
                'resp_a'    =>  'Tablón de anuncios digital.',
                'resp_b'    =>  'Certificado digital del organismo.',
                'resp_c'    =>  'Sedeelectrónica.',
                'resp_d'    =>  'Ninguna de las anteriores.',
                'correcta'  =>  'resp_c'
            ));

        //pregunta 11
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  '¿Qué ley determina el contexto de agentes y servicios que conforman el nuevo modelo de Administración al que se pretende llegar, y que como podemos deducir, y en materia de identidad digital, se asienta sobre la LFE?',
                'resp_a'    =>  'Ley11/2003.',
                'resp_b'    =>  'Ley15/1999.',
                'resp_c'    =>  'Ley7/2011.',
                'resp_d'    =>  'Ley11/2007.',
                'correcta'  =>  'resp_d'
            ));

        //pregunta 12
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  'Una "actuación administrativa producida por un sistema de información adecuadamente programado sin necesidad de intervención de una persona física en cada caso singular" se denomina, según la LAECSP:',
                'resp_a'    =>  'Actuación administrativa automatizada.',
                'resp_b'    =>  'Actuación administrativa directa.',
                'resp_c'    =>  'Actuación administrativa mejorada.',
                'resp_d'    =>  'Actuación administrativa anónima.',
                'correcta'  =>  'resp_a'
            ));

        //pregunta 13
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  '¿Qué instrumento se puede emplear para asegurar la validez de un documento impreso?',
                'resp_a'    =>  'Sello de órgano.',
                'resp_b'    =>  'Código seguro de verificación.',
                'resp_c'    =>  'A y B son correctas.',
                'resp_d'    =>  'Ninguna de las respuestas es correcta.',
                'correcta'  =>  'resp_b'
            ));

        //pregunta 14
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  'Las administraciones públicas admiten sistemas de firma electrónica conforme a lo dispuesto por la LFE. ¿Cuáles de los siguientes son válidos?',
                'resp_a'    =>  'DNIe, para personas físicas.',
                'resp_b'    =>  'Certificados digitales.',
                'resp_c'    =>  'Otros sistemas como, por ejemplo, claves concertadas.',
                'resp_d'    =>  'Todas las anteriores son correctas.',
                'correcta'  =>  'resp_d'
            ));

        //pregunta 15
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  'El DNI electrónico viene regulado por.',
                'resp_a'    =>  'Ley59/2003.',
                'resp_b'    =>  'Real Decreto 1553/2005.',
                'resp_c'    =>  'Real Decreto 1586/2009.',
                'resp_d'    =>  'Todas las anteriores son correctas.',
                'correcta'  =>  'resp_d'
            ));

        //pregunta 16
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  'El uso por parte de la Administración de estándares abiertos así como, en su caso y de forma complementaria, de estándares que sean de uso generalizado por los ciudadanos, ¿es uno de los principios de la administración electrónica?',
                'resp_a'    =>  'Sí, es el principio de neutralidad tecnológica.',
                'resp_b'    =>  'Sí, es el principio de simplificación administrativa.',
                'resp_c'    =>  'Sí, es el principio de accesibilidad.',
                'resp_d'    =>  'No, la ley 11/2007 no recoge expresamente este principio.',
                'correcta'  =>  'resp_a'
            ));

        //pregunta 17
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  'La publicación de actos y comunicaciones en tablón de anuncios electrónico,...',
                'resp_a'    =>  'Puede complementar al tablón de anuncios presencial, pero no sustituirlo.',
                'resp_b'    =>  'Puede sustituir o complementar al tablón de anuncios presencial.',
                'resp_c'    =>  'No se recomienda.',
                'resp_d'    =>  'No es un concepto recogido por la Ley 11/2007.',
                'correcta'  =>  'resp_b'
            ));

        //pregunta 18
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  '¿Qué formato de firma es el más apropiado para la firma longeva de los siguientes?',
                'resp_a'    =>  'XAdES-A.',
                'resp_b'    =>  'XAdES-T.',
                'resp_c'    =>  'XAdES-X.',
                'resp_d'    =>  'XAdES-C.',
                'correcta'  =>  'resp_a'
            ));

        //pregunta 19
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  '¿Qué formato de firma es el más apropiado para su entrega a usuarios?',
                'resp_a'    =>  'XAdES.',
                'resp_b'    =>  'CAdES.',
                'resp_c'    =>  'PAdES.',
                'resp_d'    =>  'No existen ventajas en optar por un formato u otro.',
                'correcta'  =>  'resp_c'
            ));

        //pregunta 20
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  '¿Cuál de los siguientes formatos utilizaría para firma longeva?',
                'resp_a'    =>  'XAdES-C.',
                'resp_b'    =>  'PAdES-LTV.',
                'resp_c'    =>  'EPES Profile.',
                'resp_d'    =>  'Ninguno de los anteriores.',
                'correcta'  =>  'resp_b'
            ));

        //pregunta 21
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  'Con respecto al formato CAdES-T.',
                'resp_a'    =>  'Es utilizado por PAdES-BES Profile.',
                'resp_b'    =>  'Incluye información de sellado de tiempo.',
                'resp_c'    =>  'A y B son correctas.',
                'resp_d'    =>  'A y B son falsas.',
                'correcta'  =>  'resp_c'
            ));

        //pregunta 22
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  '¿Cuáles de las siguientes enumeraciones incluye un elemento extraño?',
                'resp_a'    =>  'Firma en lote; Firma Desatendida; Multifirma.',
                'resp_b'    =>  'Firma Centralizada; Firma digitalizada; Multifirma de lotes.',
                'resp_c'    =>  'Firma en lote; Multifirma; Multifirma de lotes.',
                'resp_d'    =>  'Firma en lote; Firma detached; Firma Desatendida.',
                'correcta'  =>  'resp_d'
            ));

        //pregunta 23
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  '¿Cuál de las siguientes NO es una opción para la generación del recibo de firma de un documento firmado?',
                'resp_a'    =>  'QR Code.',
                'resp_b'    =>  'Código de barras UCC128.',
                'resp_c'    =>  'Generación de un cajetín de firma.',
                'resp_d'    =>  'Permalink al perfil del usuario en la aplicación.',
                'correcta'  =>  'resp_d'
            ));

        //pregunta 24
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  '¿Es posible la supresión de la necesidad de aportar cualquier documento acreditativo en los procedimientos administrativos (SCSP)?',
                'resp_a'    =>  'Sí, si es de manera automatizada.',
                'resp_b'    =>  'Sí, basta con que el ciudadano lo autorice.',
                'resp_c'    =>  'No, queda restringido a identidad y datos de residencia.',
                'resp_d'    =>  'Ninguna de las respuestas anteriores es correcta.',
                'correcta'  =>  'resp_d'
            ));

        //pregunta 25
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  '¿Cuál de las siguientes es una plataforma para el uso de certificados digitales de uso generalizado en la Administración Pública española?',
                'resp_a'    =>  '@firma.',
                'resp_b'    =>  'Afirm@.',
                'resp_c'    =>  'E-firma.',
                'resp_d'    =>  'Ninguna de las anteriores es correcta.',
                'correcta'  =>  'resp_a'
            ));

        //pregunta 26
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  'La plataforma indicada en la pregunta anterior tiene un software que se ejecuta en cliente llamado Cliente de Firma. ¿Cuál es la afirmación FALSA?',
                'resp_a'    =>  'Existe una versión ligera del cliente llamada miniapplet del cliente de firma.',
                'resp_b'    =>  'El miniapplet del cliente de firma está desarrollado íntegramente en javascript para hacerlo más ligero.',
                'resp_c'    =>  'El Cliente de firma es un applet Java.',
                'resp_d'    =>  'El miniapplet de firma permite acceder a la clave privada asociada al certificado del cliente.',
                'correcta'  =>  'resp_b'
            ));

        //pregunta 27
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  'La notificación electrónica se puede practicar mediante...',
                'resp_a'    =>  'Un correo electrónico ordinario.',
                'resp_b'    =>  'Una aplicación web que registre el acceso a una página determinada.',
                'resp_c'    =>  'Una aplicación web que registre el acceso a una página determinada, siempre que la identificación sea mediante certificado digital.',
                'resp_d'    =>  'Ninguna de las anteriores.',
                'correcta'  =>  'resp_b'
            ));

        //pregunta 28
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  '¿En qué contexto puede encontrar el Número de Referencia Completo (NRC)?',
                'resp_a'    =>  'Notificación electrónica.',
                'resp_b'    =>  'Registro electrónico.',
                'resp_c'    =>  'Firmaelectrónica.',
                'resp_d'    =>  'Pago electrónico.',
                'correcta'  =>  'resp_d'
            ));

        //pregunta 29
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  '¿Cómo se conoce a la firma múltiple en la que cada firma refrenda a la firma anterior?',
                'resp_a'    =>  'Cofirma.',
                'resp_b'    =>  'Multifirma.',
                'resp_c'    =>  'Contrafirma.',
                'resp_d'    =>  'Ninguna de las anteriores.',
                'correcta'  =>  'resp_c'
            ));

        //pregunta 30
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  'La definición "Información de cualquier naturaleza en forma electrónica, archivada en un soporte electrónico según un formato determinado y susceptible de identificación y tratamiento diferenciado" se corresponde con:',
                'resp_a'    =>  'Documento electrónico.',
                'resp_b'    =>  'Compulsa electrónica.',
                'resp_c'    =>  'Factura electrónica.',
                'resp_d'    =>  'Expediente electrónico.',
                'correcta'  =>  'resp_a'
            ));

        //pregunta 31
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  'La identificación mediante funcionario público...',
                'resp_a'    =>  'Es una forma reconocida de identificación de los ciudadanos.',
                'resp_b'    =>  'Requiere que el ciudadano y el funcionario cuenten con certificado digital.',
                'resp_c'    =>  'Se puede usar en cualquier circunstancia.',
                'resp_d'    =>  'Todas las anteriores son correctas.',
                'correcta'  =>  'resp_a'
            ));

        //pregunta 32
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  'Son características del Código Seguro de Verificación:',
                'resp_a'    =>  'El carácter único del código generado para cada documento.',
                'resp_b'    =>  'Su vinculación con el documento generado y con el firmante.',
                'resp_c'    =>  'Se debe garantizar la posibilidad de verificar el documento por el tiempo que se establezca en la resolución que autorice la aplicación de este procedimiento.',
                'resp_d'    =>  'Todas las anteriores.',
                'correcta'  =>  'resp_d'
            ));

        //pregunta 33
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  'El Registro General de Protección de Datos contiene:',
                'resp_a'    =>  'La estructura y los datos de los ficheros de datos de carácter personal que han sido declarados.',
                'resp_b'    =>  'La estructura de los ficheros de datos de carácter personal que han sido declarados.',
                'resp_c'    =>  'El listado de los ficheros de datos de carácter personal que han sido declarados.',
                'resp_d'    =>  'La estructura de los ficheros de datos de carácter personal que han sido declarados por las administraciones públicas.',
                'correcta'  =>  'resp_b'
            ));

        //pregunta 34
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  'Todos los datos de carácter personal recogidos deben cumplir...',
                'resp_a'    =>  'Principio del consentimiento del afectado.',
                'resp_b'    =>  'Principio de información.',
                'resp_c'    =>  'Principio de calidad de los datos.',
                'resp_d'    =>  'Todas las respuestas anteriores son correctas.',
                'correcta'  =>  'resp_d'
            ));

        //pregunta 35
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  '¿Qué significan los derechos ARCO?',
                'resp_a'    =>  'Acceso, rectificación, cancelación y oposición.',
                'resp_b'    =>  'Acceso, revisión, cancelación y oposición.',
                'resp_c'    =>  'Anonimización, rectificación, cancelación y oposición.',
                'resp_d'    =>  'Acceso, rectificación, cancelación y ofuscación.',
                'correcta'  =>  'resp_a'
            ));

        //pregunta 36
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  'La Protección de Datos de Carácter Personal viene regulada en:',
                'resp_a'    =>  'Ley 15/1999.',
                'resp_b'    =>  'R.D. 1720/2007.',
                'resp_c'    =>  'A y B.',
                'resp_d'    =>  'Ley 15/1999 y 34/2001.',
                'correcta'  =>  'resp_c'
            ));

        //pregunta 37
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  'El Esquema Nacional de Seguridad viene regulado en: ',
                'resp_a'    =>  'R.D. 3/2010.',
                'resp_b'    =>  'R.D. 3/2011.',
                'resp_c'    =>  'R.D. 4/2010.',
                'resp_d'    =>  'R.D. 4/2011.',
                'correcta'  =>  'resp_a'
            ));

        //pregunta 38
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  'El Esquema Nacional de Seguridad recoge:',
                'resp_a'    =>  'Medidas relacionadas con la organización global de la seguridad.',
                'resp_b'    =>  'Medidas para proteger la operación del sistema como conjunto integral de componentes para un fin.',
                'resp_c'    =>  'Protección de activos concretos, según su naturaleza y la calidad exigida por el nivel de seguridad de las dimensiones afectadas. ',
                'resp_d'    =>  'Todas las respuestas anteriores son correctas.',
                'correcta'  =>  'resp_d'
            ));

        //pregunta 39
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  'Las Dimensiones de Seguridad recogidas en el ENS son:',
                'resp_a'    =>  'Disponibilidad. Trazabilidad. Autenticidad. Integridad. Confidencialidad.',
                'resp_b'    =>  'Disponibilidad. Trazabilidad. Autenticidad. Neutralidad. Integridad. Confidencialidad.',
                'resp_c'    =>  'Disponibilidad. Autenticidad. Integridad. Confidencialidad. Legalidad.',
                'resp_d'    =>  'Disponibilidad. Trazabilidad. Accesibilidad. Integridad. Confidencialidad..',
                'correcta'  =>  'resp_a'
            ));

        //pregunta 40
        \DB::table('preguntas')->insert(array(
                'examen_id' =>  $i,
                'pregunta'  =>  'El Esquema Nacional de Interoperabilidad viene regulado en:',
                'resp_a'    =>  'R.D. 4/2011.',
                'resp_b'    =>  'R.D. 3/2010.',
                'resp_c'    =>  'R.D. 4/2012.',
                'resp_d'    =>  'R.D. 4/2010.',
                'correcta'  =>  'resp_d'
            ));
        }
        //pregunta 
        // \DB::table('preguntas')->insert(array(
        //         'examen_id' =>  1,
        //         'pregunta'  =>  '',
        //         'resp_a'    =>  '',
        //         'resp_b'    =>  '',
        //         'resp_c'    =>  '',
        //         'resp_d'    =>  '',
        //         'correcta'  =>  ''
        //     ));

        //Duplicamos para las otras asignaturas y simular que tienen preguntas

        

    }

}

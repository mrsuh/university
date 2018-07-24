<?php

use PHPHtmlParser\Dom;
use University\Student;
use University\Students;
use University\Statistic;

/** @var \Composer\Autoload\ClassLoader $autoload */
$loader = require(__DIR__ . '/../vendor/autoload.php');
$loader->add('University', __DIR__ . '/../src');

const FILE = 'unecon_m';
const URL  = 'https://priem.unecon.ru/stat/stat_konkurs.php?y=2018&filial_kod=1&zayav_type_kod=1&obr_konkurs_kod=0&recomend_type=null&rec_status_kod=all&ob_forma_kod=1&ob_osnova_kod=1&konkurs_grp_kod=3025&prior=1&status_kod=all&is_orig_doc=all&has_agreement=all&orig_doc_d=all&show=%D0%9F%D0%BE%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C%20https://priem.unecon.ru/stat/stat_konkurs.php?';

$ctx  = stream_context_create(['http' => ['timeout' => 60]]);
$html = file_get_contents(URL, false, $ctx);

$strpos = mb_strpos($html, '<h3>ОБЩИЙ КОНКУРС<br> (140 мест)</h3>');
$html   = mb_substr($html, $strpos, mb_strlen($html));

$dom = new Dom;
$dom->load($html);

$students = new Students();
$index    = 0;
foreach ($dom->find('tbody tr') as $tr) {

    $tds = $tr->find('td');

    $points      = (int)$tds[4]->text;
    $keyDoc      = 10;
    $keyAccept   = 11;
    $keyOtherWay = 12;
    if (false !== mb_strpos(mb_strtolower($tds[4]->text), 'без вступительных ')) {
        $points      = 9999999999;
        $keyDoc      = 7;
        $keyAccept   = 8;
        $keyOtherWay = 9;
    }

    $student =
        (new Student())
            ->setIndex($index++)
            ->setName($tds[1]->find('a')->text)
            ->setPoints($points)
            ->setDocumentType(false !== mb_strpos(mb_strtolower($tds[$keyDoc]->text), 'подлинник') ? Student::DOCUMENT_ORIGINAL : Student::DOCUMENT_COPY)
            ->setAccept(false !== mb_strpos(mb_strtolower($tds[$keyAccept]->text), '+'))
            ->setOtherWay(false !== mb_strpos(mb_strtolower($tds[$keyOtherWay]->text), 'забрали документы'));

    $students->add($student);
}

$statistic = new Statistic($students);

file_put_contents(__DIR__ . '/../tmp/' . FILE, serialize($statistic));
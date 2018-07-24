<?php

use PHPHtmlParser\Dom;
use University\Student;
use University\Students;
use University\Statistic;

/** @var \Composer\Autoload\ClassLoader $autoload */
$loader = require(__DIR__ . '/../vendor/autoload.php');
$loader->add('University', __DIR__ . '/../src');

const FILE = 'spbtsu';
const URL  = 'http://www.spbstu.ru/abit/admission-campaign/ajax.php?ab_email=Y&ab_action=getHtmlItems&groupId=631&concursForm=1%2C2&original=any&confirm=all';

$ctx  = stream_context_create(['http' => ['timeout' => 60]]);
$html = file_get_contents(URL, false, $ctx);

$dom = new Dom;
$dom->load($html);
$students = new Students();
$index    = 0;
foreach ($dom->find('tbody tr') as $tr) {
    $tds     = $tr->find('td');
    $student =
        (new Student())
            ->setIndex($index++)
            ->setName($tds[1]->text)
            ->setPoints((int)$tds[3]->text + (int)$tds[7]->text)
            ->setDocumentType(false !== mb_strpos(mb_strtolower($tds[8]->text), 'копия') ? Student::DOCUMENT_COPY : Student::DOCUMENT_ORIGINAL)
            ->setAccept(false !== mb_strpos(mb_strtolower($tds[9]->text), 'да'))
            ->setOtherWay(false !== mb_strpos(mb_strtolower($tds[9]->text), 'согласие по др'));

    $students->add($student);
}

$statistic = new Statistic($students);

file_put_contents(__DIR__ . '/../tmp/' . FILE, serialize($statistic));

<?php
/*

Poniższy program wyświetla na ekranie wyniki konkursu dla dzieci. Wyniki są w tablicy quizResults. Zmienna thershold to próg punktowy, który należy osiągnąć by znaleźć się wśród zwycięzców.
W pętli usuwane są rekordy, które nie spełniły tego warunku.
Na końcu wyświetlana jest lista. Pomimo, że program dobrze obliczył liczbę zwycięzców, lista jest pokazywana niepoprawnie:

1) Ania - 75 pkt,
2)  -  pkt,
3)  -  pkt,
4) Kasia - 81 pkt,
5)  -  pkt,
6) Kamil - 63 pkt,

Proszę poprawić program tak, aby podawał właściwe wyniki.

 */
$quizResults = [
    ["Ania", 75],
    ["Piotrek", 32],
    ["Asia", 43],
    ["Kasia", 81],
    ["Bartek", 11],
    ["Kamil", 63],
    ["Ola", 76],
    ["Ludmiła", 49],
    ["Tosia", 92],
    ["Krzyś", 89],
];

$thershold = 50;

$contestantsCount = count($quizResults);
for ($n = 0; $n < $contestantsCount; $n++) {
    if ($quizResults[$n][1] < $thershold) {
        unset($quizResults[$n]);
    }
}
$quizResults = array_values($quizResults);

$winnersCount = count($quizResults);
print "Oto lista laureatów konkursu dla dzieci. Należało zdobyć przynajmneij $thershold punktów i warunek spełniło $winnersCount osób. A oto zwycięzcy:\n\n";
for ($n = 0; $n < $winnersCount; $n++) {
    print ($n + 1) . ") " . $quizResults[$n][0] . " - " . $quizResults[$n][1] . " pkt,\n";
}

/**
 * Po wystatowaniu skryptu otrzymujemy następujący wynik:
 * php Zadanie2.php
Oto lista laureatów konkursu dla dzieci. Należało zdobyć przynajmneij 50 punktów i warunek spełniło 6 osób. A oto zwycięzcy:

1) Ania - 75 pkt,

Warning: Undefined array key 1 in /var/www/symfony/rekrutacja/Zadanie2.php on line 43

Warning: Trying to access array offset on value of type null in /var/www/symfony/rekrutacja/Zadanie2.php on line 43

Warning: Undefined array key 1 in /var/www/symfony/rekrutacja/Zadanie2.php on line 43

Warning: Trying to access array offset on value of type null in /var/www/symfony/rekrutacja/Zadanie2.php on line 43
2)  -  pkt,

Warning: Undefined array key 2 in /var/www/symfony/rekrutacja/Zadanie2.php on line 43

Warning: Trying to access array offset on value of type null in /var/www/symfony/rekrutacja/Zadanie2.php on line 43

Warning: Undefined array key 2 in /var/www/symfony/rekrutacja/Zadanie2.php on line 43

Warning: Trying to access array offset on value of type null in /var/www/symfony/rekrutacja/Zadanie2.php on line 43
3)  -  pkt,
4) Kasia - 81 pkt,

Warning: Undefined array key 4 in /var/www/symfony/rekrutacja/Zadanie2.php on line 43

Warning: Trying to access array offset on value of type null in /var/www/symfony/rekrutacja/Zadanie2.php on line 43

Warning: Undefined array key 4 in /var/www/symfony/rekrutacja/Zadanie2.php on line 43

Warning: Trying to access array offset on value of type null in /var/www/symfony/rekrutacja/Zadanie2.php on line 43
5)  -  pkt,
6) Kamil - 63 pkt,
 *
 *
 * Petla for sprawdza kazdy element tablicy co prowadzi do literowania po nie istniejacych elementach tablicy
 *
 * W podanym rozwiazaniu resetujemy tablice za pomoca array_values($quizResults); co powoduje ze indeksy tablicy sa ponownie ustawiane od 0
 */


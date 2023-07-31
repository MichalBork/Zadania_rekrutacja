<?php

/*
Chcemy stworzyć aplikację do ankietowania klientów.
Proszę zaprojektować strukturę DTO dla takiej aplikacji. 
Celem zadania nie jest zaprojektowanie bazy danych, lecz struktury obiektów, które będą zwracane na frontend podczas żądań do API. Choć oczywiście do pewnego stopnia te rzeczy są podobne.
Oto główne założenia aplikacji:

Pytań może być wiele rodzajów:
- pytania otwarte
- pytania tak / nie
- pytania tak / nie / nie wiem
- ocena w skali 1 - 10 (w tym skrajne odpowiedzi mają swoje opisy, np. dobrze/źle lub szybko/wolno)
- ocena w skali 1 - 5

Jedna ankieta może składać się z dowolnej ilości pytań dowolnego rodzaju.

Ankiet w całej aplikacji może być dużo. Ankety mają swój czas trwania (data od - data do)

Aplikacja z założenia tworzy ankiety anonimowe, tzn. nie trzeba się autoryzować aby odpowiedzieć na pytanie.

Proszę nie implementować żadnej funkcjonalności, wystarczą same klasy. Mile widziane jest użycie klas abstrakcyjnych.
*/

/**
 *
Question: To jest klasa abstrakcyjna, która reprezentuje pojedyncze pytanie. Zawiera niezbędne informacje, takie jak id, message (treść pytania) i type (typ pytania).
QuestionType: Definiuje wartosc przypisana do typu pytania. Može to być np. pytania otwarte, tak/nie, itp.
OpenQuestion: Jest to konkretna klasa, która rozszerza klasę abstrakcyjną Question i reprezentuje pytanie otwarte. Przy tworzeniu obiektu tej klasy typ pytania ustawiany jest na QuestionType::Open.
CheckboxQuestion: Podobnie jak OpenQuestion, ta klasa dziedziczy po klasie Question, ale reprezentuje pytanie wielokrotnego wyboru (checkbox). Zawiera dodatkowy parametr $answers, który zawiera możliwe odpowiedzi na pytanie.
ScaleQuestion: Ta klasa rozszerza również klasę Question i reprezentuje pytania oceniające na określonej skali. Skala jest przekazywana jako tablica z dwoma elementami $lowest i $highest, które reprezentują najniższą i najwyższą wartość skali.
ScaleType: To jest specjalna klasa do reprezentowania wartości skali. Każda wartość skali ma liczbę ($value) i opis ($description).
Survey: To jest główna klasa reprezentująca całą ankietę. Zawiera id, name (nazwę ankiety), startDate, endDate (daty rozpoczęcia i zakończenia ankiety) oraz questions (tablicę pytań w ankiecie).
 Nie dodawalem getterow bo nie widze potrzeby w przykladzie.
 */

abstract class Question
{

    protected int $id;
    protected string $message;

    protected QuestionType $type;
}

enum QuestionType: string
{
    case Open = 'open';
    case YesNo = 'yesno';
    case YesNoDontKnow = 'yesnoidk';
    case Scale1to10 = 'scale1to10';
    case Scale1to5 = 'scale1to5';

    public function getType(): string
    {
        return $this->value;
    }
}


class OpenQuestion extends Question
{
    public function __construct(int $id, string $message)
    {
        $this->id = $id;
        $this->message = $message;
        $this->type = QuestionType::Open;
    }
}


class CheckboxQuestion extends Question
{
    private array $answers;

    public function __construct(int $id, string $message, array $answers, QuestionType $type)
    {
        $this->id = $id;
        $this->message = $message;
        $this->answers = $answers;
        $this->type = $type;
    }

}

class ScaleQuestion extends Question
{
    private array $scale;

    public function __construct(int $id, string $message, QuestionType $type, ScaleType $lowest, ScaleType $highest)
    {
        $this->id = $id;
        $this->message = $message;
        $this->type = $type;
        $this->scale = [$lowest, $highest];
    }


}


class ScaleType
{
    private int $value;
    private ?string $description;

    public function __construct(int $value, ?string $description)
    {
        $this->value = $value;
        $this->description = $description;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }


}

class Survey
{
    private int $id;
    private string $name;
    private DateTime $startDate;
    private DateTime $endDate;
    private array $questions;

    public function __construct(int $id, string $name, DateTime $startDate, DateTime $endDate, array $questions)
    {
        $this->id = $id;
        $this->name = $name;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->questions = $questions;
    }

}


$survey = new Survey(
    1,
    'Survey 1',
    new DateTime('2021-01-01'),
    new DateTime('2021-01-31'),
    [
        new OpenQuestion(1, 'Open question 1'),
        new CheckboxQuestion(2, 'Checkbox question 1', ['Answer 1', 'Answer 2'], QuestionType::YesNo),
        new CheckboxQuestion(3, 'Checkbox question 2', ['Answer 1', 'Answer 2', 'Answer 3'], QuestionType::YesNoDontKnow),
        new ScaleQuestion(4, 'Scale question 1', QuestionType::Scale1to10, new ScaleType(1, 'Bad'), new ScaleType(10, 'Good')),
        new ScaleQuestion(5, 'Scale question 2', QuestionType::Scale1to5, new ScaleType(1, 'Bad'), new ScaleType(5, 'Good')),
    ]
);

var_dump($survey);
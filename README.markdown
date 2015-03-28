## Zadanie testowe 2015-03-30 Autentika

#### Treść zadania

#####Krótki opis oczekiwanego działania modułu:

Moduł ten ma posłużyd do tworzenia przez użytkowników listy lokalizacji – możemy przyjąd, że chodzi o Imprezy które odbędą się pod wskazanym adresem i będą trwały w określonym przedziale
czasowym (data od – do). Moduł wyświetla listę dodanych imprez, a użytkownik może odnaleźd najbliższe wpisując w wyszukiwarkę swój adres.
Strona miejsca/imprezy wyświetla informacje o niej i umożliwia dodanie komentarza. Dodatkowo możliwe jest usunięcie dodanego komentarza (na potrzeby zadania – bez weryfikacji czy usuwający jest jego autorem).

#####Kroki działania aplikacji:
1. Użytkownik dodaje do bazy danych rekord opisujący lokalizację (miejsce), dane wprowadza przez formularz:
    
    a. Pola formularza:

         i. Nazwa miejsca – pole tekstowe ograniczone do 50 znaków (walidacja: wypełnienie pola, sprawdzenie przekroczenia dopuszczalnego limitu znaków)
         ii. Opis miejsca – pole textarea ograniczone do 300 znaków (walidacja: wypełnienie pola, sprawdzenie przekroczenia dopuszczalnego limitu znaków)
         iii. Adres – pole tekstowe ograniczone do 50 znaków (walidacja: wypełnienie pola, sprawdzenie przekroczenia dopuszczalnego limitu znaków)
         iv. Email (walidacja: wypełnienie pola, zgodnośd z formatem e-mail)
         v. Dostępnośd od-do – dwa pola na datę (walidacja: wypełnienie obu pól, pole „od” musi mied mniejszą wartośd od pola „do”, obie daty muszą wskazywad termin nie bliższy niż „za 7 dni”)
    b. Formularz musi zostad skonstruowany z użyciem Zend_Form i zendowskiej walidacji

    c. Dla pola „Adres” pobieramy i zapisujemy w bazie długośd i szerokośd geograficzną, korzystając z API Google Maps

2. W momencie zapisu lokalizacji do bazy – wysyła się e-mail na stały adres administratora serwisu z powiadomieniem o dodaniu nowej lokalizacji (nazwa miejsca + link do strony na froncie serwisu) – przyjmimy tu: admin@domena.pl

3. Moduł wyświetla listę dodanych do bazy miejsc

4. Moduł umożliwia wyszukanie miejsca po adresie (filtrowanie listy, wyszukiwanie na niej):

    a. Wyszukiwarka zawiera pole „Podaj adres”

    b. Wyszukiwarka wyświetla wyniki które znajdują się w odległości 2km od wskazanego miejsca (wyszukanie po danych lokalizacyjnych w bazie)
	
5. Moduł umożliwia przejście do strony ze szczegółami wybranego miejsca (wyświetlenie danych które zostały wprowadzone przez formularz z pkt 1)

6. Na stronie danego miejsca użytkownik może dodad do niego komentarz:

    a. Formularz składający się z pól: Komentarz, E-mail

    b. Formularz skonstruowany z użyciem Zend_Form i zendowskiej walidacji

    c. Walidacja wypełnienia pól (oba obowiązkowe) i poprawności formatu e-mail

    d. Dodane komentarze wyświetlają się na stronie miejsca do którego są przypisane, kolejnośd – od najnowszych do najstarszych

    e. Możliwe jest usunięcie dowolnego komentarza linkiem „usuo” (na potrzeby tego zadania nie ma potrzeby weryfikacji czy usuwający jest autorem komentarza)

Zastrzeżenia:

* Kod musi byd oparty o Zend Framework 2 , ewentualnie Zend Framework 1
* Ocenie podlega sposób wytwarzania kodu PHP, jego formatowanie, komentowanie itd. Nie ma potrzeby zajmowania się warstwą wizualną – nie będziemy weryfikowad HTML, CSS i JS.
* Formularze i walidatory muszą byd generowane przez klasy Zenda. Walidacja browser-side nie jest wymagana.

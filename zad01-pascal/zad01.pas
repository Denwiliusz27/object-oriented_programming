// docker run --rm -it -v ${PWD}:/home/student/projobj/ kprzystalski/projobj-pascal:latest
program zad01;

var
  randomNumbers: array[0..49] of integer;
  testArray: array[0..4] of Integer = ( 5, 4, 3, 2, 1);

// procedura wypisująca elementy podanej tablicy
procedure writeArray(var testArray: Array of Integer);
var i: Integer;

begin
  for i := 0 to Length(testArray)-1 do
  begin
    Write(testArray[i], ' ');
  end;
  WriteLn();
end;


// procedura generująca n losowych liczb w przedziale od 
procedure generateNumbers(var numbersArray: Array of Integer);
var i : Integer;

begin
  Randomize;

  for i := 0 to 49 do
  begin
    numbersArray[i] := Random(101);
  end;
end;


procedure bubbleSort(var numbersArray: Array of Integer);
var i, j, temp: Integer;

begin
  for i := 0 to Length(numbersArray)-2 do
    begin
      for j := 0 to Length(numbersArray)-2 do
        begin
          if (numbersArray[j] > numbersArray[j+1]) then
            begin
              temp := numbersArray[j];
              numbersArray[j] := numbersArray[j+1];
              numbersArray[j+1] := temp;
            end;
        end;
    end;
end;


begin
  generateNumbers(randomNumbers);
  WriteLn('Generated array:');
  writeArray(randomNumbers);

  bubbleSort(randomNumbers);
  WriteLn('Array after Bubble Sort:');
  writeArray(randomNumbers);
end.

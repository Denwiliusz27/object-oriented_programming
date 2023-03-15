// docker run --rm -it -v ${PWD}:/home/student/projobj/ kprzystalski/projobj-pascal:latest
program zad01;

var
  randomNumbers: array of integer;
  testArray: array[0..7] of Integer = ( 4, 2, 6, 2, 1, 7, 8, 4);


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


// procedura generująca n losowych liczb w przedziale od do
procedure generateNumbers(start_pos, end_pos, number : Integer);
var i : Integer;

begin
  Randomize;
  SetLength(randomNumbers,number);

  if (start_pos < 0) or (end_pos < 0) or (start_pos > end_pos) or (number < 0) then
  begin
    WriteLn('ERROR: inapropriate arguments');
    exit;
  end;

  for i := 0 to number-1 do
  begin
    randomNumbers[i] := Random(end_pos-start_pos+1) + start_pos;
  end;
end;


// procedura sortująca liczby za pomocą sortowania bąbelkowego
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
  generateNumbers(0 ,100, 50);
  WriteLn('Generated array of 50 random elements from 0 to 100:');
  writeArray(randomNumbers);

  bubbleSort(randomNumbers);
  WriteLn('randomNumbers array after Bubble Sort:');
  writeArray(randomNumbers);

  generateNumbers(20 ,40, 10);
  WriteLn('Generated array of 10 random elements from 20 to 40:');
  writeArray(randomNumbers);

  bubbleSort(testArray);
  WriteLn('Test array after Bubble Sort:');
  writeArray(testArray);
end.

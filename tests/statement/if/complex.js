var result;

if ((1 !== 2 && !(2 < 3)) || (!(1 !== 2) && 2 < 3)) {
  console.log('This should be true');
  result = true;
  console.log(result);
  if (((true) && (1)) || ((false) || (true === 1))) {
    console.log('true');
  } else if (((true) && (0)) || ((false) || (0))) {
    console.log(false);
  } else if (!('I don\'t have any other idea' === true)) {
    console.log('5+5');
    console.log(' = ');
    console.log(5 + 5);
    if (5 + 5 == 10) {
      console.log('Hurray');
    }
  } else {
    console.log('Nested else branch');
  }
} else {
  console.log('Else.');
}
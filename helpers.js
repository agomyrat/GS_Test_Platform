/// Validating Date
 // param: d -> day
 // param: m -> month
 // param: y -> year
 // given params can be string and can be number
 // 
 // returns only correct day
const validateDate = (d, m, y) => {
   y = Number(y);
   m = Number(m);
   d = Number(d);
 
   let a = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
   if (y % 400 === 0 || y % 4 === 0 && y % 100 !== 0) a[1] = 29;
   
   --m;

   if (a[m] < d) d = a[m];
   
   return d;
};

let b = validateDate(29, 2, 2019);
console.log(b);

module.exports = {
   validateDate,
};
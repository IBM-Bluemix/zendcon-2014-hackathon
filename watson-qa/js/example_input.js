var examples = [
  'What are fun things to do in London?',
  'How should I get around Berlin?',
  'What should I see in Prague?'  
];

function loadExample() {
  document.getElementById('questionText').value = examples[Math.floor(Math.random()*examples.length)];
}

//fill and submit the form with a random example
function showExample() {
  loadExample();
  document.getElementById('qaForm').submit();
}

document.onload=
  (document.getElementById('questionText').value == '')?
    loadExample() : '';
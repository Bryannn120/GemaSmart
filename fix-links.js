const fs = require('fs');

function fixLinks(filePath) {
  let content = fs.readFileSync(filePath, 'utf8');
  
  // Replace data-path="xxx" href="#" with data-path="xxx" href="/xxx"
  content = content.replace(/data-path="([^"]+)" href="#"/g, 'data-path="$1" href="/$1"');
  
  // Also handle href="#" data-path="xxx" if they exist in that order
  content = content.replace(/href="#" data-path="([^"]+)"/g, 'href="/$1" data-path="$1"');

  // Specific fix for "login" / logout which might just go to /login
  
  fs.writeFileSync(filePath, content);
  console.log('Fixed links in', filePath);
}

fixLinks('c:\\sibibit\\app\\dashboard\\page.tsx');
fixLinks('c:\\sibibit\\app\\data-penerima\\page.tsx');
fixLinks('c:\\sibibit\\app\\program-bantuan\\page.tsx');
fixLinks('c:\\sibibit\\app\\penyaluran-bibit\\page.tsx');
fixLinks('c:\\sibibit\\app\\laporan\\page.tsx');

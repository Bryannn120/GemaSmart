const fs = require('fs');

function convert(htmlFile, outputFile, componentName) {
  let content = fs.readFileSync(htmlFile, 'utf8');
  
  // Replace known problematic inequality signs in text
  content = content.replace(/<50%/g, '&lt;50%');
  content = content.replace(/>14 Hari/g, '&gt;14 Hari');
  content = content.replace(/>80%/g, '&gt;80%');
  content = content.replace(/>10%/g, '&gt;10%');

  // Extract body
  const bodyMatch = content.match(/<body[^>]*>([\s\S]*?)<\/body>/i);
  if (bodyMatch) {
    content = bodyMatch[1];
  }
  
  // Remove all script tags to prevent JSX compilation errors
  content = content.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, '');
  
  // Basic JSX conversions
  content = content.replace(/class=/g, 'className=');
  content = content.replace(/onclick="[^"]*"/gi, 'onClick={() => {}}');
  content = content.replace(/onsubmit="[^"]*"/gi, 'onSubmit={(e) => e.preventDefault()}');
  content = content.replace(/\b(disabled|selected|required|autofocus|checked)="[^"]*"/gi, '$1');
  content = content.replace(/for=/g, 'htmlFor=');
  content = content.replace(/viewbox=/g, 'viewBox=');
  content = content.replace(/stroke-width=/g, 'strokeWidth=');
  content = content.replace(/stroke-linecap=/g, 'strokeLinecap=');
  content = content.replace(/stroke-linejoin=/g, 'strokeLinejoin=');
  content = content.replace(/stroke-dasharray=/g, 'strokeDasharray=');
  content = content.replace(/stroke-dashoffset=/g, 'strokeDashoffset=');
  content = content.replace(/clip-path=/g, 'clipPath=');
  content = content.replace(/fill-rule=/g, 'fillRule=');
  
  // Fix void elements closing tags
  const voidElements = ['area', 'base', 'br', 'col', 'embed', 'hr', 'img', 'input', 'link', 'meta', 'param', 'source', 'track', 'wbr'];
  voidElements.forEach(tag => {
    const regex = new RegExp(`<${tag}([^>]*?)(?<!/)>`, 'gi');
    content = content.replace(regex, `<${tag}$1 />`);
  });

  // Convert HTML comments to JSX comments
  content = content.replace(/<!--([\s\S]*?)-->/g, '{/*$1*/}');

  // Handle styles
  content = content.replace(/style="([^"]*)"/g, (match, styleStr) => {
    const styleObj = styleStr.split(';').filter(s => s.trim()).reduce((acc, rule) => {
      const [key, value] = rule.split(':').map(s => s.trim());
      if (key && value) {
        // preserve CSS variables like --color-surface
        let camelKey = key;
        if (!key.startsWith('--')) {
          camelKey = key.replace(/-([a-z])/g, g => g[1].toUpperCase());
        }
        acc.push(`"${camelKey}": "${value}"`);
      }
      return acc;
    }, []);
    return `style={{${styleObj.join(', ')}}}`;
  });

  const component = `"use client";

export default function ${componentName}() {
  return (
    <>
      ${content}
    </>
  );
}
  `;
  
  const dir = outputFile.substring(0, outputFile.lastIndexOf('\\'));
  if (!fs.existsSync(dir)) {
    fs.mkdirSync(dir, { recursive: true });
  }
  
  fs.writeFileSync(outputFile, component);
}

try {
  convert('c:\\sibibit\\tmp_html\\program-bantuan.html', 'c:\\sibibit\\app\\program-bantuan\\page.tsx', 'ProgramBantuan');
  convert('c:\\sibibit\\tmp_html\\penyaluran-bibit.html', 'c:\\sibibit\\app\\penyaluran-bibit\\page.tsx', 'PenyaluranBibit');
  console.log("Conversion successful");
} catch (e) {
  console.error(e);
}

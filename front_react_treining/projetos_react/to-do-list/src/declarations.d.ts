// Como o typescript por padrão não reconhecer arquivos de extensões 
// que não são padrão da linguagem como: .js, .jsx, .ts, .tsx
// devemos fazer configurações ou criar módulos para que ele possa reconhecer 
// estes arquivos

declare module '*.svg' {
    const content: any;
    export default content;
}

declare module '*.png' {
    const content: any;
    export default content;
}

declare module '*.jpg' {
    const content: any;
    export default content;
}

// Resolução para arquivos CSS
// Para CSS de efeito colateral (como index.css) ou CSS Modules que retornam um objeto de classes.
// Para imports simples como em `import './index.css'`, o TypeScript só precisa saber que é um módulo.
declare module '*.css';

// Se você estivesse usando CSS Modules (ex: MyComponent.module.css), a declaração seria:
/*
declare module '*.module.css' {
    const classes: { readonly [key: string]: string };
    export default classes;
}
*/

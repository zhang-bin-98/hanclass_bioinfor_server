import MermaidPlugin from "vitepress-plugin-mermaid";
import { defineConfig } from 'vitepress'


export default defineConfig({
    base: '/students/202128010315003/docs/',
    title: '课程设计文档',
    markdown: {
        config: MermaidPlugin,
    },
    themeConfig: {
        nav: [
            { 
                text: '首页', 
                link: '/'
            },
            { 
                text: '使用介绍', 
                link: '/usage/'
            },
            {
                text: '网站设计',
                link: '/design/'
            },
            { 
                text: '数据来源与数据处理', 
                link: '/data/'
            },
            {
                text: '课程要求',
                link: '/project'
            }
        ],

        sidebar: {
            '/usage/': [{
                text: '使用介绍', 
                link: '/usage/'
            }],
            '/data/': [
                { text: '数据来源', link: '/data/' },
                { text: '数据处理', link: '/data/process' },
            ],
            '/design/': [
                { text: '基本介绍', link: '/design/' },
                { text: '功能设计', link: '/design/server' },
                { text: '数据库设计', link: '/design/database' },
                { 
                    text: 'API设计', 
                    children: [
                        { text: '序列', link: '/design/api/seq' },
                        { text: '基因', link: '/design/api/gene' },
                        { text: '用户', link: '/design/api/user' },
                    ]
                },
                { 
                    text: '页面设计', 
                    children: [
                        { text: '序列与基因', link: '/design/page/seq' },
                        { text: '用户', link: '/design/page/user' },
                        { text: '其他', link: '/design/page/other' },
                    ]
                },

            ]
        }
    }
})

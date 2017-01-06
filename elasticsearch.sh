{
        "query" : {
            "multi_match" : {
                "query" : "中国",
                "fields": ["title", "content"]
            }
        },
        "highlight": {
            "fields" : {
                "title" : {},
                "content": {}
            }
        }
}
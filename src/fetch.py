import urllib.request
import re
import json

queries = ['Matematika SMA', 'Fisika SMA', 'Kimia SMA', 'Biologi Sel', 'Sejarah Kemerdekaan', 'Bahasa Indonesia SMA', 'Bahasa Inggris SMA']
results = {}

for q in queries:
    url = 'https://www.youtube.com/results?search_query=' + urllib.parse.quote(q)
    req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
    try:
        html = urllib.request.urlopen(req).read().decode()
        ids = re.findall(r'"videoId":"(.*?)"', html)
        # filter out very short strings just in case
        ids = [i for i in ids if len(i) == 11]
        results[q] = list(set(ids))[:2]
    except Exception as e:
        results[q] = str(e)

print(json.dumps(results, indent=2))

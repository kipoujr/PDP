#include <bits/stdc++.h>
using namespace std;

#define fi first
#define se second
#define pb push_back
#define mp make_pair
typedef long long ll;
typedef pair<int, int> ii;

const int len = 1e5+5;
int sz[len], block[len], cnt[len], out;
vector<ii> adj[len];

void fix(int u, int p){
    sz[u] = 1;
    for (int j = 0; j < adj[u].size(); j++){
        ii v = adj[u][j];
        if (!block[v.fi] && v.fi != p){
            fix(v.fi, u);
            sz[u] += sz[v.fi];
        }
    }
}

ii cent(int u, int p, int all){
    ii ans = mp(all, u);
    int mx = 0, sum = 1;
    for (int j = 0; j < adj[u].size(); j++){
        ii v = adj[u][j];
        if (v.fi != p && !block[v.fi]){
            ans = min(ans, cent(v.fi, u, all));
            mx = max(mx, sz[v.fi]);
            sum += sz[v.fi];
        }
    }

    mx = max(mx, all-sum);
    return min(ans, mp(mx, u));
}

void add(int u, int p, int mx, int cur, int x){
    if (x == 1)
        cnt[mx] = max(cur, cnt[mx]);
    if (x == -1)
        cnt[mx] = 0;
    if (x == 0){
        out = max(out, cur); // no need
        out = max(out, cnt[mx]+cur);
    }

    for (int j = 0; j < adj[u].size(); j++){
        ii v = adj[u][j];
        if (v.fi != p && !block[v.fi]){
            if (v.se > mx)
                add(v.fi, u, v.se, 1, x);
            else if (v.se == mx)
                add(v.fi, u, mx, cur+1, x);
            else
                add(v.fi, u, mx, cur, x);
        }
    }
}

void solve(int cur){
    fix(cur, cur);
    int u = cent(cur, cur, sz[cur]).se;

    /// make ans update;
    for (int j = 0; j < adj[u].size(); j++){
        ii v = adj[u][j];
        if (!block[v.fi]){
            add(v.fi, u, v.se, 1, 0);
            add(v.fi, u, v.se, 1, 1);
        }
    }

    for (int j = 0; j < adj[u].size(); j++){
        ii v = adj[u][j];
        if (!block[v.fi])
            add(v.fi, u, v.se, 1, -1);
    }

    block[u] = 1;
    for (int j = 0; j < adj[u].size(); j++){
        ii v = adj[u][j];
        if (!block[v.fi])
            solve(v.fi);
    }
}

int main(){
    freopen("kazarma.in", "r", stdin);
    freopen("kazarma.out", "w", stdout);
    int n;
    scanf("%d", &n);
    for (int i = 0; i < n-1; i++){
        int a, b, c;
        scanf("%d %d %d", &a, &b, &c);
        adj[a].pb(mp(b, c));
        adj[b].pb(mp(a, c));
    }

    solve(1);

    printf("%d\n", out+1);
    return 0;
}

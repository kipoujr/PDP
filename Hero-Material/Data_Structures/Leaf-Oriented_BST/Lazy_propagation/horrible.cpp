#include <cstdio>
#include <algorithm>
using namespace std;
#define MAXN 100001
typedef long long ll;

int N, C;
ll sum[4 * MAXN], lazyv[4 * MAXN];
bool lazy[4 * MAXN];

void Init () {
	fill(sum, sum + 4*MAXN, 0);
	fill(lazy, lazy + 4*MAXN, 0);
}

void Update (int p, int q, int v,
						 int L, int R, int i) {
	if (p <= L && R <= q) {
		if (lazy[i]) lazyv[i] += v;
		else lazy[i]=1, lazyv[i] = v;
		sum[i] += (ll)v * (R - L + 1);
		return;
	}
	int M = (L+R)/2;
	if (lazy[i]) {
		lazy[i] = 0;
		if (lazy[2*i]) lazyv[2*i] += lazyv[i];
		else lazy[2*i]=1, lazyv[2*i] = lazyv[i];
		sum[2*i] += (ll)lazyv[i] * (M - L + 1);
		if (lazy[2*i+1]) lazyv[2*i+1] += lazyv[i];
		else lazy[2*i+1]=1, lazyv[2*i+1] = lazyv[i];
		sum[2*i+1] += (ll)lazyv[i] * (R - M);
	}
	if (p <= M) Update(p,q,v,L,M,2*i);
	if (q > M) Update(p,q,v,M+1,R,2*i+1);
	sum[i] = sum[2*i] + sum[2*i+1];
}

ll Sum (int p, int q, int L, int R, int i) {
	if (p <= L && R <= q) {
		return sum[i];
	}
	int M = (L+R)/2;
	if (lazy[i]) {
		lazy[i] = 0;
		if (lazy[2*i]) lazyv[2*i] += lazyv[i];
		else lazy[2*i]=1, lazyv[2*i] = lazyv[i];
		sum[2*i] += (ll)lazyv[i] * (M-L+1);
		if (lazy[2*i+1]) lazyv[2*i+1] += lazyv[i];
		else lazy[2*i+1]=1, lazyv[2*i+1] = lazyv[i];
		sum[2*i+1] += (ll)lazyv[i] * (R-M);
	}
	ll tot = 0;
	if (p <= M) tot += Sum(p,q,L,M,2*i);
	if (q > M) tot += Sum(p,q,M+1,R,2*i+1);
	return tot;
}

int main () {
	int T;
	scanf("%d",&T);
	while (T--) {
		Init();
		scanf("%d %d",&N, &C);
		while (C--) {
			int t,p,q,v;
			scanf("%d %d %d",&t,&p,&q);
			if (t == 0) {
				scanf("%d",&v);
				Update(p,q,v,1,N,1);
			}
			else printf("%lld\n",Sum(p,q,1,N,1));
		}
	}
	return 0;
}

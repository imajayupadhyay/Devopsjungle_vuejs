<?php

namespace App\Http\DataProviders;

class BlogsDataProvider
{
    public static function getIndexData()
    {
        return [
            'blogs' => self::getAllBlogs(),
            'featuredBlog' => self::getFeaturedBlog(),
        ];
    }

    public static function getDetailPageData($slug)
    {
        $blogs = self::getAllBlogs();
        $blog = collect($blogs)->firstWhere('slug', $slug);

        if (!$blog) {
            return null;
        }

        // Get related blogs (same category, excluding current)
        $relatedBlogs = collect($blogs)
            ->where('category', $blog['category'])
            ->where('slug', '!=', $slug)
            ->take(3)
            ->values()
            ->toArray();

        return [
            'blog' => $blog,
            'relatedBlogs' => $relatedBlogs,
        ];
    }

    public static function getBlogs()
    {
        return self::getAllBlogs();
    }

    public static function getFeaturedBlog()
    {
        $blogs = self::getAllBlogs();
        return $blogs[0]; // First blog is featured
    }

    public static function getBlogBySlug($slug)
    {
        $blogs = self::getAllBlogs();
        return collect($blogs)->firstWhere('slug', $slug);
    }

    private static function getAllBlogs()
    {
        return [
            [
                'id' => 1,
                'slug' => 'mastering-kubernetes-deployment-strategies',
                'title' => 'Mastering Kubernetes Deployment Strategies',
                'excerpt' => 'Learn about different deployment strategies in Kubernetes including Rolling Updates, Blue-Green deployments, and Canary releases to ensure zero-downtime deployments.',
                'content' => self::getBlogContent1(),
                'image' => 'https://images.unsplash.com/photo-1667372393119-3d4c48d07fc9?w=1200&h=600&fit=crop',
                'author' => [
                    'name' => 'Sarah Johnson',
                    'avatar' => 'https://ui-avatars.com/api/?name=Sarah+Johnson&background=047857&color=fff',
                    'role' => 'DevOps Engineer',
                    'bio' => 'Sarah is a seasoned DevOps engineer with over 8 years of experience in container orchestration and cloud-native technologies. She specializes in Kubernetes and has helped multiple Fortune 500 companies migrate to containerized infrastructure.',
                ],
                'category' => 'Kubernetes',
                'tags' => ['Kubernetes', 'DevOps', 'Deployment', 'Container Orchestration'],
                'readTime' => '8 min read',
                'publishedAt' => '2025-01-15',
                'views' => 1234,
                'featured' => true,
            ],
            [
                'id' => 2,
                'slug' => 'aws-vs-azure-vs-gcp-cloud-comparison',
                'title' => 'AWS vs Azure vs GCP: A Comprehensive Cloud Comparison',
                'excerpt' => 'Dive deep into the three major cloud providers and understand which platform best suits your infrastructure needs, pricing models, and use cases.',
                'content' => self::getBlogContent2(),
                'image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=1200&h=600&fit=crop',
                'author' => [
                    'name' => 'Michael Chen',
                    'avatar' => 'https://ui-avatars.com/api/?name=Michael+Chen&background=047857&color=fff',
                    'role' => 'Cloud Architect',
                    'bio' => 'Michael is a certified cloud architect with extensive experience across AWS, Azure, and GCP. He has designed and implemented multi-cloud strategies for organizations ranging from startups to enterprise-level companies.',
                ],
                'category' => 'Cloud',
                'tags' => ['AWS', 'Azure', 'GCP', 'Cloud Computing', 'Comparison'],
                'readTime' => '12 min read',
                'publishedAt' => '2025-01-12',
                'views' => 2156,
                'featured' => false,
            ],
            [
                'id' => 3,
                'slug' => 'ci-cd-pipeline-best-practices',
                'title' => 'CI/CD Pipeline Best Practices for Modern Development',
                'excerpt' => 'Explore essential best practices for building robust CI/CD pipelines that accelerate software delivery while maintaining quality and security.',
                'content' => self::getBlogContent3(),
                'image' => 'https://images.unsplash.com/photo-1618401471353-b98afee0b2eb?w=1200&h=600&fit=crop',
                'author' => [
                    'name' => 'Emily Rodriguez',
                    'avatar' => 'https://ui-avatars.com/api/?name=Emily+Rodriguez&background=047857&color=fff',
                    'role' => 'Senior DevOps Consultant',
                    'bio' => 'Emily is a Senior DevOps Consultant specializing in CI/CD pipeline optimization and automation. With 10+ years in the industry, she has helped numerous teams accelerate their software delivery while maintaining security and quality standards.',
                ],
                'category' => 'DevOps',
                'tags' => ['CI/CD', 'Jenkins', 'GitLab', 'Automation', 'Best Practices'],
                'readTime' => '10 min read',
                'publishedAt' => '2025-01-08',
                'views' => 1876,
                'featured' => false,
            ],
        ];
    }

    private static function getBlogContent1()
    {
        return <<<'HTML'
<div class="prose prose-invert max-w-none">
    <h2>Introduction to Kubernetes Deployment Strategies</h2>
    <p>In the world of container orchestration, Kubernetes has become the de facto standard for managing containerized applications at scale. One of the most critical aspects of running applications in production is how you deploy updates and new features. The right deployment strategy can mean the difference between seamless updates and costly downtime.</p>

    <h2>Why Deployment Strategies Matter</h2>
    <p>Modern applications require continuous updates—bug fixes, security patches, and new features need to be deployed regularly. However, traditional deployment methods often require downtime, which is unacceptable for mission-critical applications. This is where Kubernetes deployment strategies shine, offering various approaches to update your applications with minimal to zero downtime.</p>

    <h2>Rolling Updates: The Default Strategy</h2>
    <p>Rolling updates are Kubernetes' default deployment strategy and for good reason. This approach gradually replaces old pods with new ones, ensuring that your application remains available throughout the update process.</p>

    <h3>How Rolling Updates Work</h3>
    <ul>
        <li><strong>Gradual Replacement:</strong> Kubernetes creates new pods with the updated version while keeping the old pods running</li>
        <li><strong>Health Checks:</strong> New pods are only put into service after passing readiness probes</li>
        <li><strong>Controlled Rollout:</strong> You can configure the maximum number of pods that can be unavailable during the update</li>
        <li><strong>Automatic Rollback:</strong> If issues are detected, Kubernetes can automatically roll back to the previous version</li>
    </ul>

    <pre><code>apiVersion: apps/v1
kind: Deployment
metadata:
  name: my-app
spec:
  replicas: 10
  strategy:
    type: RollingUpdate
    rollingUpdate:
      maxSurge: 2
      maxUnavailable: 1
  template:
    spec:
      containers:
      - name: app
        image: my-app:v2.0</code></pre>

    <h2>Blue-Green Deployments</h2>
    <p>Blue-Green deployment is a strategy where you maintain two identical production environments—Blue (current) and Green (new). This approach provides instant rollback capabilities and zero-downtime deployments.</p>

    <h3>Benefits of Blue-Green Deployments</h3>
    <ul>
        <li><strong>Instant Rollback:</strong> Simply redirect traffic back to the blue environment if issues arise</li>
        <li><strong>Zero Downtime:</strong> The switch between environments is instantaneous</li>
        <li><strong>Testing in Production:</strong> Test the green environment with production data before switching</li>
        <li><strong>Reduced Risk:</strong> The previous version remains intact until you're confident in the new release</li>
    </ul>

    <h2>Canary Releases</h2>
    <p>Canary releases allow you to roll out changes to a small subset of users before making them available to everyone. This strategy is named after the "canary in a coal mine" concept—using a small population to detect problems before they affect everyone.</p>

    <h3>Implementing Canary Deployments</h3>
    <p>Start by routing a small percentage (e.g., 5-10%) of traffic to the new version while monitoring key metrics like error rates, response times, and user behavior. If everything looks good, gradually increase traffic to the new version until it serves 100% of users.</p>

    <h2>Best Practices</h2>
    <ul>
        <li><strong>Always Use Health Checks:</strong> Implement both liveness and readiness probes</li>
        <li><strong>Monitor Everything:</strong> Set up comprehensive monitoring and alerting</li>
        <li><strong>Automate Testing:</strong> Include automated tests in your deployment pipeline</li>
        <li><strong>Plan for Rollback:</strong> Always have a rollback strategy ready</li>
        <li><strong>Version Your Images:</strong> Never use the 'latest' tag in production</li>
    </ul>

    <h2>Conclusion</h2>
    <p>Choosing the right deployment strategy depends on your specific requirements, risk tolerance, and infrastructure. Rolling updates work well for most scenarios, while blue-green deployments are ideal when instant rollback is crucial. Canary releases excel when you need to test changes with real users before full rollout.</p>

    <p>The key is to understand each strategy's strengths and limitations, then implement the one that best fits your application's needs. Remember, the goal is always to deliver value to users quickly and safely.</p>
</div>
HTML;
    }

    private static function getBlogContent2()
    {
        return <<<'HTML'
<div class="prose prose-invert max-w-none">
    <h2>The Cloud Wars: AWS, Azure, and GCP</h2>
    <p>The cloud computing market is dominated by three major players: Amazon Web Services (AWS), Microsoft Azure, and Google Cloud Platform (GCP). Each offers a comprehensive suite of services, but they differ in pricing, features, and strengths. Let's dive deep into what makes each platform unique.</p>

    <h2>Market Share and Maturity</h2>
    <p><strong>AWS</strong> leads the pack with approximately 32% market share, having launched in 2006. Its first-mover advantage means it has the most mature ecosystem, extensive service catalog, and largest community.</p>

    <p><strong>Azure</strong> holds around 23% market share and excels in hybrid cloud solutions, particularly for enterprises already invested in Microsoft technologies. Its seamless integration with Active Directory, Office 365, and other Microsoft products is unmatched.</p>

    <p><strong>GCP</strong> has about 10% market share but is growing rapidly. While smaller, it offers cutting-edge technology, especially in machine learning, big data analytics, and containerization with Kubernetes (which Google originally developed).</p>

    <h2>Pricing Models Compared</h2>
    <h3>AWS Pricing</h3>
    <ul>
        <li><strong>Pay-as-you-go:</strong> No upfront costs, pay only for what you use</li>
        <li><strong>Reserved Instances:</strong> Up to 75% savings with 1-3 year commitments</li>
        <li><strong>Spot Instances:</strong> Bid on unused capacity for up to 90% savings</li>
        <li><strong>Savings Plans:</strong> Flexible pricing model with significant discounts</li>
    </ul>

    <h3>Azure Pricing</h3>
    <ul>
        <li><strong>Pay-as-you-go:</strong> Similar to AWS, no upfront costs</li>
        <li><strong>Reserved Instances:</strong> Up to 72% savings with commitments</li>
        <li><strong>Hybrid Benefit:</strong> Use existing Windows Server licenses for major savings</li>
        <li><strong>Dev/Test Pricing:</strong> Discounted rates for development and testing</li>
    </ul>

    <h3>GCP Pricing</h3>
    <ul>
        <li><strong>Per-second billing:</strong> More granular than AWS/Azure's per-minute billing</li>
        <li><strong>Sustained Use Discounts:</strong> Automatic discounts for running workloads</li>
        <li><strong>Committed Use Discounts:</strong> Similar to reserved instances</li>
        <li><strong>Preemptible VMs:</strong> Like AWS Spot instances, up to 80% savings</li>
    </ul>

    <h2>Compute Services Comparison</h2>
    <table>
        <thead>
            <tr>
                <th>Service Type</th>
                <th>AWS</th>
                <th>Azure</th>
                <th>GCP</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Virtual Machines</td>
                <td>EC2</td>
                <td>Virtual Machines</td>
                <td>Compute Engine</td>
            </tr>
            <tr>
                <td>Containers</td>
                <td>ECS, EKS</td>
                <td>AKS, Container Instances</td>
                <td>GKE, Cloud Run</td>
            </tr>
            <tr>
                <td>Serverless</td>
                <td>Lambda</td>
                <td>Functions</td>
                <td>Cloud Functions</td>
            </tr>
        </tbody>
    </table>

    <h2>Storage Solutions</h2>
    <p>All three providers offer robust storage solutions, but with different strengths:</p>

    <p><strong>AWS S3</strong> is the gold standard for object storage, offering 11 9's of durability and extensive features like lifecycle policies, versioning, and cross-region replication.</p>

    <p><strong>Azure Blob Storage</strong> integrates seamlessly with Microsoft's ecosystem and offers hot, cool, and archive tiers for cost optimization.</p>

    <p><strong>Google Cloud Storage</strong> provides the fastest performance and simplest pricing structure, with automatic data classification and intelligent tiering.</p>

    <h2>Machine Learning and AI</h2>
    <p><strong>GCP</strong> leads in this space with TensorFlow, AutoML, and advanced AI APIs. Google's expertise in AI gives it a significant edge.</p>

    <p><strong>AWS</strong> offers SageMaker, a comprehensive ML platform, along with specialized services like Rekognition for image analysis and Comprehend for natural language processing.</p>

    <p><strong>Azure</strong> provides Azure Machine Learning and cognitive services, with excellent integration into the Microsoft ecosystem.</p>

    <h2>Which Should You Choose?</h2>
    <h3>Choose AWS if:</h3>
    <ul>
        <li>You need the largest selection of services and features</li>
        <li>You want the most mature ecosystem and largest community</li>
        <li>You're building new cloud-native applications from scratch</li>
        <li>You need the widest global infrastructure coverage</li>
    </ul>

    <h3>Choose Azure if:</h3>
    <ul>
        <li>You're heavily invested in Microsoft technologies</li>
        <li>You need strong hybrid cloud capabilities</li>
        <li>You want seamless Active Directory integration</li>
        <li>You're running Windows-based workloads</li>
    </ul>

    <h3>Choose GCP if:</h3>
    <ul>
        <li>You're focused on data analytics and machine learning</li>
        <li>You want the best Kubernetes experience</li>
        <li>You need the most transparent and simple pricing</li>
        <li>You value cutting-edge technology over ecosystem maturity</li>
    </ul>

    <h2>The Multi-Cloud Strategy</h2>
    <p>Many organizations don't choose just one—they adopt a multi-cloud strategy to avoid vendor lock-in and leverage each provider's strengths. For example, you might use AWS for general compute, Azure for enterprise applications, and GCP for big data analytics.</p>

    <h2>Conclusion</h2>
    <p>There's no universally "best" cloud provider. AWS offers the most comprehensive services, Azure excels in enterprise and hybrid scenarios, and GCP leads in data analytics and AI. Evaluate your specific needs, existing infrastructure, and future goals to make the right choice for your organization.</p>
</div>
HTML;
    }

    private static function getBlogContent3()
    {
        return <<<'HTML'
<div class="prose prose-invert max-w-none">
    <h2>The Evolution of Software Delivery</h2>
    <p>Continuous Integration and Continuous Deployment (CI/CD) has revolutionized how we build, test, and deploy software. What once took weeks or months can now be accomplished in minutes. However, building an effective CI/CD pipeline requires more than just automation—it demands careful planning, best practices, and continuous improvement.</p>

    <h2>What is CI/CD?</h2>
    <p><strong>Continuous Integration (CI)</strong> is the practice of automatically building and testing code changes as soon as they're committed to version control. This helps catch integration issues early when they're cheaper and easier to fix.</p>

    <p><strong>Continuous Deployment (CD)</strong> takes this further by automatically deploying all code changes that pass the automated tests to production. Continuous Delivery (also CD) is similar but requires manual approval before production deployment.</p>

    <h2>Core Principles of Effective CI/CD</h2>
    <h3>1. Version Everything</h3>
    <p>Not just your application code—version your infrastructure code, configuration files, database schemas, and even your CI/CD pipeline definitions. Infrastructure as Code (IaC) tools like Terraform, CloudFormation, or Pulumi make this possible.</p>

    <pre><code># Example: Versioned pipeline configuration
version: 2.1
orbs:
  node: circleci/node@5.0.0
jobs:
  build:
    docker:
      - image: cimg/node:18.0.0
    steps:
      - checkout
      - node/install-packages
      - run: npm run build
      - run: npm test</code></pre>

    <h3>2. Automate Everything</h3>
    <p>Manual processes are error-prone and slow. Automate:</p>
    <ul>
        <li>Code compilation and building</li>
        <li>Running unit, integration, and end-to-end tests</li>
        <li>Security scanning and vulnerability detection</li>
        <li>Code quality checks (linting, code coverage)</li>
        <li>Artifact creation and versioning</li>
        <li>Deployment to all environments</li>
        <li>Database migrations</li>
        <li>Rollback procedures</li>
    </ul>

    <h3>3. Build Once, Deploy Many</h3>
    <p>Create your build artifact (Docker image, JAR file, etc.) once and use the same artifact across all environments. This ensures consistency and eliminates the "it works on my machine" problem.</p>

    <h2>Essential Pipeline Stages</h2>
    <h3>Source Stage</h3>
    <p>Everything starts with version control. Use Git with a branching strategy like GitFlow or trunk-based development. Implement branch protection rules and require pull request reviews.</p>

    <h3>Build Stage</h3>
    <p>Compile your code, resolve dependencies, and create deployable artifacts. This stage should be fast—aim for under 10 minutes to maintain rapid feedback loops.</p>

    <h3>Test Stage</h3>
    <p>Implement a testing pyramid:</p>
    <ul>
        <li><strong>Unit Tests:</strong> Fast, isolated tests (70% of your tests)</li>
        <li><strong>Integration Tests:</strong> Test component interactions (20%)</li>
        <li><strong>End-to-End Tests:</strong> Test complete user workflows (10%)</li>
    </ul>

    <h3>Security Stage</h3>
    <p>Shift security left by integrating security scanning early in your pipeline:</p>
    <ul>
        <li>Static Application Security Testing (SAST)</li>
        <li>Dependency vulnerability scanning</li>
        <li>Container image scanning</li>
        <li>Infrastructure security checks</li>
    </ul>

    <h3>Deploy Stage</h3>
    <p>Deploy to multiple environments progressively:</p>
    <ol>
        <li><strong>Development:</strong> Automatic deployment on every commit</li>
        <li><strong>Staging:</strong> Mirror of production for final testing</li>
        <li><strong>Production:</strong> Automated or manual gate based on your needs</li>
    </ol>

    <h2>Best Practices for Pipeline Design</h2>
    <h3>Keep Pipelines Fast</h3>
    <p>Slow pipelines discourage frequent commits and reduce productivity. Optimize by:</p>
    <ul>
        <li>Running tests in parallel</li>
        <li>Caching dependencies</li>
        <li>Using incremental builds</li>
        <li>Failing fast on errors</li>
    </ul>

    <h3>Make Pipelines Reliable</h3>
    <p>Flaky tests and unreliable pipelines erode trust. Address this by:</p>
    <ul>
        <li>Fixing or removing flaky tests immediately</li>
        <li>Using deterministic test data</li>
        <li>Implementing proper retry mechanisms</li>
        <li>Monitoring pipeline health metrics</li>
    </ul>

    <h3>Provide Clear Feedback</h3>
    <p>Developers need to know exactly what failed and why. Ensure your pipeline provides:</p>
    <ul>
        <li>Detailed error messages</li>
        <li>Links to relevant logs</li>
        <li>Notifications to the right people</li>
        <li>Historical trend data</li>
    </ul>

    <h2>Common CI/CD Tools</h2>
    <h3>Jenkins</h3>
    <p>The most popular open-source automation server. Highly customizable with thousands of plugins, but requires maintenance and infrastructure.</p>

    <h3>GitLab CI/CD</h3>
    <p>Built into GitLab, offering a complete DevOps platform. Excellent for teams already using GitLab for version control.</p>

    <h3>GitHub Actions</h3>
    <p>Native to GitHub with marketplace of pre-built actions. Great for open-source projects and GitHub users.</p>

    <h3>CircleCI</h3>
    <p>Cloud-native CI/CD with excellent Docker support and performance optimization features.</p>

    <h2>Measuring Success</h2>
    <p>Track these key metrics to measure your CI/CD effectiveness:</p>
    <ul>
        <li><strong>Deployment Frequency:</strong> How often do you deploy to production?</li>
        <li><strong>Lead Time:</strong> Time from commit to production</li>
        <li><strong>Mean Time to Recovery (MTTR):</strong> How quickly can you recover from failures?</li>
        <li><strong>Change Failure Rate:</strong> Percentage of deployments causing failures</li>
    </ul>

    <h2>Advanced Patterns</h2>
    <h3>Feature Flags</h3>
    <p>Decouple deployment from release by using feature flags. Deploy code to production but activate features selectively.</p>

    <h3>Progressive Delivery</h3>
    <p>Combine deployment strategies (canary, blue-green) with monitoring to automatically promote or roll back releases based on metrics.</p>

    <h3>GitOps</h3>
    <p>Use Git as the single source of truth for infrastructure and applications. Tools like ArgoCD and Flux automate deployments based on Git commits.</p>

    <h2>Conclusion</h2>
    <p>Building effective CI/CD pipelines is a journey, not a destination. Start with the basics—automate builds and tests—then gradually add more sophisticated features like security scanning, progressive delivery, and comprehensive monitoring.</p>

    <p>Remember: the goal isn't just to deploy faster, but to deploy better. A well-designed CI/CD pipeline gives you confidence to release frequently while maintaining quality and stability.</p>
</div>
HTML;
    }
}

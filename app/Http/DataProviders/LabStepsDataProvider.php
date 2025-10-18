<?php

namespace App\Http\DataProviders;

class LabStepsDataProvider
{
    /**
     * Get detailed lab data with steps for a specific exam and lab
     */
    public static function getLabWithSteps(string $examId, string $labId): ?array
    {
        $labsData = [
            'aws-saa-c03' => [
                '1' => [
                    'id' => 1,
                    'title' => 'Setting up VPC with Public and Private Subnets',
                    'description' => 'Learn to create a secure VPC architecture with public and private subnets, NAT gateways, and proper routing.',
                    'difficulty' => 'Intermediate',
                    'duration' => '45 mins',
                    'category' => 'networking',
                    'icon' => 'fas fa-network-wired',
                    'steps' => [
                        [
                            'id' => 1,
                            'title' => 'Create a VPC',
                            'description' => 'Start by creating a new VPC with the specified CIDR block.',
                            'estimatedTime' => '5 mins',
                            'instructions' => '<p>Navigate to the VPC console and create a new VPC with the following specifications:</p><ul><li>Name: MyLabVPC</li><li>IPv4 CIDR block: 10.0.0.0/16</li><li>IPv6 CIDR block: No IPv6 CIDR block</li><li>Tenancy: Default</li></ul>',
                            'code' => 'aws ec2 create-vpc --cidr-block 10.0.0.0/16 --tag-specifications "ResourceType=vpc,Tags=[{Key=Name,Value=MyLabVPC}]"',
                            'codeTitle' => 'AWS CLI Command',
                            'expectedOutput' => '{\n    "Vpc": {\n        "CidrBlock": "10.0.0.0/16",\n        "DhcpOptionsId": "dopt-12345678",\n        "State": "pending",\n        "VpcId": "vpc-12345678",\n        "OwnerId": "123456789012",\n        "InstanceTenancy": "default",\n        "Ipv6CidrBlockAssociationSet": [],\n        "CidrBlockAssociationSet": [\n            {\n                "AssociationId": "vpc-cidr-assoc-12345678",\n                "CidrBlock": "10.0.0.0/16",\n                "CidrBlockState": {\n                    "State": "associated"\n                }\n            }\n        ],\n        "IsDefault": false,\n        "Tags": [\n            {\n                "Key": "Name",\n                "Value": "MyLabVPC"\n            }\n        ]\n    }\n}',
                            'tips' => [
                                'Note down the VPC ID as you\'ll need it for subsequent steps',
                                'The /16 CIDR block provides 65,536 IP addresses',
                                'Always use descriptive names for better resource management'
                            ],
                            'resources' => [
                                [
                                    'title' => 'VPC User Guide',
                                    'description' => 'AWS official documentation',
                                    'url' => 'https://docs.aws.amazon.com/vpc/latest/userguide/',
                                    'icon' => 'fas fa-book'
                                ],
                                [
                                    'title' => 'VPC CIDR Calculator',
                                    'description' => 'Calculate subnet ranges',
                                    'url' => 'https://www.subnet-calculator.com/',
                                    'icon' => 'fas fa-calculator'
                                ]
                            ]
                        ],
                        [
                            'id' => 2,
                            'title' => 'Create Public Subnet',
                            'description' => 'Create a public subnet that will host resources accessible from the internet.',
                            'estimatedTime' => '5 mins',
                            'instructions' => '<p>Create a public subnet with these specifications:</p><ul><li>Name: PublicSubnet</li><li>VPC: Select your newly created VPC</li><li>Availability Zone: us-east-1a (or your preferred AZ)</li><li>IPv4 CIDR block: 10.0.1.0/24</li></ul>',
                            'code' => 'aws ec2 create-subnet --vpc-id vpc-12345678 --cidr-block 10.0.1.0/24 --availability-zone us-east-1a --tag-specifications "ResourceType=subnet,Tags=[{Key=Name,Value=PublicSubnet}]"',
                            'codeTitle' => 'Create Public Subnet',
                            'expectedOutput' => '{\n    "Subnet": {\n        "AvailabilityZone": "us-east-1a",\n        "CidrBlock": "10.0.1.0/24",\n        "State": "available",\n        "SubnetId": "subnet-12345678",\n        "VpcId": "vpc-12345678",\n        "MapPublicIpOnLaunch": false,\n        "Tags": [\n            {\n                "Key": "Name",\n                "Value": "PublicSubnet"\n            }\n        ]\n    }\n}',
                            'tips' => [
                                'Public subnets will route traffic to an Internet Gateway',
                                'The /24 CIDR provides 256 IP addresses (251 usable)',
                                'Choose an Availability Zone that supports your resource requirements'
                            ],
                            'resources' => [
                                [
                                    'title' => 'Subnet Documentation',
                                    'description' => 'Learn more about VPC subnets',
                                    'url' => 'https://docs.aws.amazon.com/vpc/latest/userguide/VPC_Subnets.html',
                                    'icon' => 'fas fa-book'
                                ]
                            ]
                        ],
                        [
                            'id' => 3,
                            'title' => 'Create Private Subnet',
                            'description' => 'Create a private subnet for resources that should not be directly accessible from the internet.',
                            'estimatedTime' => '5 mins',
                            'instructions' => '<p>Create a private subnet with these specifications:</p><ul><li>Name: PrivateSubnet</li><li>VPC: Select your VPC</li><li>Availability Zone: us-east-1b (different from public subnet)</li><li>IPv4 CIDR block: 10.0.2.0/24</li></ul>',
                            'code' => 'aws ec2 create-subnet --vpc-id vpc-12345678 --cidr-block 10.0.2.0/24 --availability-zone us-east-1b --tag-specifications "ResourceType=subnet,Tags=[{Key=Name,Value=PrivateSubnet}]"',
                            'codeTitle' => 'Create Private Subnet',
                            'expectedOutput' => '{\n    "Subnet": {\n        "AvailabilityZone": "us-east-1b",\n        "CidrBlock": "10.0.2.0/24",\n        "State": "available",\n        "SubnetId": "subnet-87654321",\n        "VpcId": "vpc-12345678",\n        "MapPublicIpOnLaunch": false,\n        "Tags": [\n            {\n                "Key": "Name",\n                "Value": "PrivateSubnet"\n            }\n        ]\n    }\n}',
                            'tips' => [
                                'Private subnets route traffic through NAT Gateway/Instance',
                                'Use different AZs for high availability',
                                'Private subnets are ideal for databases and backend services'
                            ],
                            'resources' => []
                        ],
                        [
                            'id' => 4,
                            'title' => 'Create Internet Gateway',
                            'description' => 'Create and attach an Internet Gateway to enable internet access for the VPC.',
                            'estimatedTime' => '5 mins',
                            'instructions' => '<p>Create an Internet Gateway and attach it to your VPC:</p><ul><li>Name: MyLabIGW</li><li>Attach to: MyLabVPC</li></ul>',
                            'code' => 'aws ec2 create-internet-gateway --tag-specifications "ResourceType=internet-gateway,Tags=[{Key=Name,Value=MyLabIGW}]"\naws ec2 attach-internet-gateway --internet-gateway-id igw-12345678 --vpc-id vpc-12345678',
                            'codeTitle' => 'Create and Attach Internet Gateway',
                            'tips' => [
                                'Each VPC can have only one Internet Gateway',
                                'Internet Gateway enables communication between VPC and internet',
                                'Required for public subnets to access the internet'
                            ],
                            'resources' => []
                        ]
                    ]
                ],
                '2' => [
                    'id' => 2,
                    'title' => 'Deploying Auto Scaling Web Application',
                    'description' => 'Deploy a highly available web application using EC2 Auto Scaling Groups and Application Load Balancer.',
                    'difficulty' => 'Advanced',
                    'duration' => '60 mins',
                    'category' => 'compute',
                    'icon' => 'fas fa-server',
                    'steps' => [
                        [
                            'id' => 1,
                            'title' => 'Create Launch Template',
                            'description' => 'Create a launch template for EC2 instances with web server configuration.',
                            'estimatedTime' => '10 mins',
                            'instructions' => '<p>Create a launch template with the following specifications:</p><ul><li>Name: WebServerTemplate</li><li>AMI: Amazon Linux 2</li><li>Instance Type: t3.micro</li><li>Security Group: WebServerSG (create if needed)</li><li>User Data: Install and start Apache web server</li></ul>',
                            'code' => 'aws ec2 create-launch-template --launch-template-name WebServerTemplate --launch-template-data \'{\n  "ImageId": "ami-0abcdef1234567890",\n  "InstanceType": "t3.micro",\n  "SecurityGroupIds": ["sg-12345678"],\n  "UserData": "IyEvYmluL2Jhc2gKZG5mIHVwZGF0ZSAteQpkbmYgaW5zdGFsbCAteSBodHRwZApzeXN0ZW1jdGwgc3RhcnQgaHR0cGQKc3lzdGVtY3RsIGVuYWJsZSBodHRwZApjaG1vZCAreCAvc2VydmljZXMKL3NlcnZpY2VzIHN0YXJ0"\n}\'',
                            'codeTitle' => 'Create Launch Template',
                            'tips' => [
                                'Launch templates provide versioning for instance configurations',
                                'User data script runs when instance boots',
                                'Security groups control network access to instances'
                            ],
                            'resources' => []
                        ]
                    ]
                ]
            ]
        ];

        $examLabs = $labsData[$examId] ?? [];
        return $examLabs[$labId] ?? null;
    }

    /**
     * Get exam data by ID (simplified version)
     */
    public static function getExamById(string $examId): ?array
    {
        return PracticeLabsDataProvider::getExamById($examId);
    }

    /**
     * Get all data for the lab steps page
     */
    public static function getLabStepsData(string $examId, string $labId): array
    {
        $exam = self::getExamById($examId);
        $lab = self::getLabWithSteps($examId, $labId);

        if (!$exam || !$lab) {
            return [];
        }

        return [
            'exam' => $exam,
            'lab' => $lab
        ];
    }

    /**
     * Get next lab in sequence for navigation
     */
    public static function getNextLab(string $examId, string $currentLabId): ?array
    {
        $labs = ExamLabsDataProvider::getLabsForExam($examId);
        $currentIndex = -1;

        foreach ($labs as $index => $lab) {
            if ($lab['id'] == $currentLabId) {
                $currentIndex = $index;
                break;
            }
        }

        if ($currentIndex >= 0 && isset($labs[$currentIndex + 1])) {
            return $labs[$currentIndex + 1];
        }

        return null;
    }

    /**
     * Get previous lab in sequence for navigation
     */
    public static function getPreviousLab(string $examId, string $currentLabId): ?array
    {
        $labs = ExamLabsDataProvider::getLabsForExam($examId);
        $currentIndex = -1;

        foreach ($labs as $index => $lab) {
            if ($lab['id'] == $currentLabId) {
                $currentIndex = $index;
                break;
            }
        }

        if ($currentIndex > 0) {
            return $labs[$currentIndex - 1];
        }

        return null;
    }
}